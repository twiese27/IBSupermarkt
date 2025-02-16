import networkx as nx
from collections import defaultdict
import pandas as pd
from sqlalchemy import create_engine, text

def get_db_connection():
    # Create a connection to the Oracle database using SQLAlchemy
    user = "ONLINESHOP_PROD"
    password = "onlineshop_prod"
    host = "134.106.62.237"
    port = "1521"
    service_name = "dbprak2"

    dsn = f"oracle+oracledb://{user}:{password}@{host}:{port}/?service_name={service_name}"
    engine = create_engine(dsn)
    return engine

def build_product_graph(rules_df):
    """Erstellt einen gerichteten Graphen aus den Assoziationsregeln"""
    G = nx.DiGraph()
    
    for _, rule in rules_df.iterrows():
        antecedent = rule['antecedent']
        consequent = rule['consequent']
        
        # Füge Kante mit Gewicht (lift) hinzu
        G.add_edge(antecedent, consequent, weight=rule['lift'])
    
    return G

def find_connected_products(G, product_id, max_depth=2):
    """Findet verbundene Produkte bis zur angegebenen Tiefe"""
    connected_products = defaultdict(float)
    
    # BFS bis zur maximalen Tiefe
    for depth in range(1, max_depth + 1):
        paths = nx.single_source_shortest_path(G, product_id, cutoff=depth)
        
        for target, path in paths.items():
            if target != product_id:
                # Berechne Gesamtgewicht des Pfades
                path_weight = 1.0
                for i in range(len(path)-1):
                    path_weight *= G[path[i]][path[i+1]]['weight']
                
                # Speichere höchstes gefundenes Gewicht
                connected_products[target] = max(
                    connected_products[target],
                    path_weight
                )
    
    return connected_products

def get_product_recommendations(product_id, engine):
    """Holt Produktempfehlungen aus der Datenbank"""
    # Lade Assoziationsregeln
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
    
    # Erstelle Graph
    G = build_product_graph(rules_df)
    
    # Finde verbundene Produkte
    connected_products = find_connected_products(G, product_id)
    
    # Sortiere nach Gewicht
    sorted_products = sorted(
        connected_products.items(),
        key=lambda x: x[1],
        reverse=True
    )
    
    return sorted_products

def save_recommendations_to_db(engine, recommendations_dict):
    """Speichert alle Produktempfehlungen in der Datenbank"""
    with engine.connect() as connection:
        # Lösche alte Empfehlungen
        connection.execute(text("DELETE FROM PRODUCT_RECOMMENDATION"))
        
        # Füge neue Empfehlungen ein
        for source_id, recommendations in recommendations_dict.items():
            for target_id, score in recommendations:
                connection.execute(
                    text("""
                    INSERT INTO PRODUCT_RECOMMENDATION 
                    (PRODUCT_RECOMMENDATION_ID, ANTECEDENT_ID, CONSEQUENT_ID, 
                     RECOMMENDATION_SCORE)
                    VALUES 
                    (RECOMMENDATION_SEQ.NEXTVAL, :source, :target, :score)
                    """),
                    {
                        "source": source_id,
                        "target": target_id,
                        "score": float(score)
                    }
                )
        connection.commit()

def get_all_source_products(engine):
    """Holt alle Produkte, die als Antezedenzien vorkommen"""
    query = """
    SELECT DISTINCT PRODUCT_ID 
    FROM RULE_ANTECEDENT
    """
    return pd.read_sql(query, engine)['product_id'].tolist()

def main():
    print("Starting advanced basket analysis...")
    engine = get_db_connection()
    
    # Hole alle Quellprodukte
    source_products = get_all_source_products(engine)
    print(f"Found {len(source_products)} source products")
    
    # Sammle alle Empfehlungen
    all_recommendations = {}
    for idx, product_id in enumerate(source_products, 1):
        print(f"Processing product {idx}/{len(source_products)} (ID: {product_id})")
        recommendations = get_product_recommendations(product_id, engine)
        all_recommendations[product_id] = recommendations
    
    print("\nSaving recommendations to database...")
    save_recommendations_to_db(engine, all_recommendations)
    print("Analysis completed successfully!")

if __name__ == "__main__":
    main()