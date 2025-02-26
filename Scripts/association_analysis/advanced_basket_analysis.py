from db_connection import get_sqlalchemy_engine
import networkx as nx
from collections import defaultdict
import pandas as pd
from sqlalchemy import create_engine, text

def get_db_connection():
    """Stellt eine Verbindung zur Datenbank über SQLAlchemy her."""
    return get_sqlalchemy_engine()

def build_product_graph(rules_df):
    """
    Erstellt einen gerichteten Graphen aus Assoziationsregeln.
    
    Args:
        rules_df (DataFrame): DataFrame mit Assoziationsregeln
    
    Returns:
        DiGraph: Gerichteter Graph mit Produktbeziehungen
    """
    G = nx.DiGraph()
    
    for _, rule in rules_df.iterrows():
        antecedent = rule['antecedent']
        consequent = rule['consequent']
        G.add_edge(antecedent, consequent, weight=rule['lift'])
    
    return G

def find_connected_products(G, product_id, max_depth=2):
    """
    Identifiziert verbundene Produkte durch Breitensuche im Graphen.
    
    Args:
        G (DiGraph): Produktgraph
        product_id (int): ID des Ausgangsprodukts
        max_depth (int): Maximale Suchtiefe, Standard ist 2
    
    Returns:
        dict: Verbundene Produkte mit ihren Gewichtungen
    """
    connected_products = defaultdict(float)
    
    for depth in range(1, max_depth + 1):
        paths = nx.single_source_shortest_path(G, product_id, cutoff=depth)
        
        for target, path in paths.items():
            if target != product_id:
                # Berechne Pfadgewicht als Produkt der einzelnen Kantengewichte
                path_weight = 1.0
                for i in range(len(path)-1):
                    path_weight *= G[path[i]][path[i+1]]['weight']
                connected_products[target] = max(
                    connected_products[target],
                    path_weight
                )
    
    return connected_products

def get_product_recommendations(product_id, engine):
    """
    Ermittelt Produktempfehlungen basierend auf Assoziationsregeln.
    
    Args:
        product_id (int): Produkt-ID
        engine: SQLAlchemy Engine
    
    Returns:
        list: Sortierte Liste von (Produkt-ID, Gewichtung)-Tupeln
    """
    # Lade relevante Assoziationsregeln
    query = """
    SELECT DISTINCT
           ar.ASSOCIATION_RULE_ID,
           ar.LIFT,
           ar.CONFIDENCE,
           ra.PRODUCT_ID as antecedent,
           rc.PRODUCT_ID as consequent
    FROM ASSOCIATION_RULE ar
    JOIN RULE_ANTECEDENT ra ON ar.ASSOCIATION_RULE_ID = ra.ASSOCIATION_RULE_ID
    JOIN RULE_CONSEQUENT rc ON ar.ASSOCIATION_RULE_ID = rc.ASSOCIATION_RULE_ID
    WHERE ar.LIFT > 1
    """
    rules_df = pd.read_sql(query, engine)
    
    G = build_product_graph(rules_df)
    connected_products = find_connected_products(G, product_id)
    
    return sorted(
        connected_products.items(),
        key=lambda x: x[1],
        reverse=True
    )

def save_recommendations_to_db(engine, recommendations_dict):
    """
    Speichert berechnete Produktempfehlungen in der Datenbank.
    
    Args:
        engine: SQLAlchemy Engine
        recommendations_dict (dict): Dictionary mit Empfehlungen
    """
    with engine.connect() as connection:
        connection.execute(text("DELETE FROM PRODUCT_RECOMMENDATION"))
        
        recommendation_id = 1
        
        for source_id, recommendations in recommendations_dict.items():
            for target_id, score in recommendations:
                connection.execute(
                    text("""
                    INSERT INTO PRODUCT_RECOMMENDATION 
                    (PRODUCT_RECOMMENDATION_ID, ANTECEDENT_ID, CONSEQUENT_ID, 
                     RECOMMENDATION_SCORE)
                    VALUES 
                    (:recommendation_id, :source, :target, :score)
                    """),
                    {
                        "recommendation_id": recommendation_id,
                        "source": source_id,
                        "target": target_id,
                        "score": float(score)
                    }
                )
                recommendation_id += 1
        connection.commit()

def get_all_source_products(engine):
    """
    Ermittelt alle Produkte, die als Ausgangspunkt für Empfehlungen dienen.
    
    Args:
        engine: SQLAlchemy Engine
    
    Returns:
        list: Liste von Produkt-IDs
    """
    query = "SELECT DISTINCT PRODUCT_ID FROM RULE_ANTECEDENT"
    return pd.read_sql(query, engine)['product_id'].tolist()

def main():
    print("Starting advanced basket analysis...")
    engine = get_db_connection()
    
    source_products = get_all_source_products(engine)
    print(f"Processing {len(source_products)} products for recommendations")
    
    all_recommendations = {}
    for idx, product_id in enumerate(source_products, 1):
        print(f"Analyzing product {idx}/{len(source_products)} [ID: {product_id}]")
        recommendations = get_product_recommendations(product_id, engine)
        all_recommendations[product_id] = recommendations
    
    print("\nSaving recommendations to database...")
    save_recommendations_to_db(engine, all_recommendations)
    print("Analysis completed successfully!")

if __name__ == "__main__":
    main()