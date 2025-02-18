from db_connection import get_sqlalchemy_engine
from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine
from sqlalchemy.sql import text

def get_db_connection():
    """Erstellt eine Datenbankverbindung über SQLAlchemy."""
    return get_sqlalchemy_engine()

def fetch_transaction_data():
    """
    Lädt Kategorietransaktionen aus der Datenbank.
    
    Returns:
        DataFrame: Enthält SHOPPING_CART_ID und product_category_id
    """
    print("\nStep 1: Establishing database connection...")
    engine = get_db_connection()
    print("Fetching transaction data in chunks...")
    
    query = """
        SELECT s.SHOPPING_CART_ID, c.product_category_id
        FROM PRODUCT_TO_SHOPPING_CART s
        JOIN PRODUCT p ON s.product_id = p.product_id
        JOIN PRODUCT_CATEGORY c ON p.product_category_id = c.product_category_id
    """
    
    chunks = []
    chunk_count = 0
    for chunk in pd.read_sql(query, engine, chunksize=100000):
        chunk_count += 1
        print(f"Processing chunk {chunk_count} ({len(chunk)} rows)...")
        chunks.append(chunk)
    
    print(f"Concatenating {chunk_count} chunks...")
    df = pd.concat(chunks, ignore_index=True)
    print(f"Total transactions loaded: {len(df)} rows")
    return df

def clear_existing_category_rules(engine):
    """
    Löscht alle existierenden Kategorieregeln aus der Datenbank.
    
    Args:
        engine: SQLAlchemy Engine-Instanz
    """
    print("\nStep 2: Clearing existing category rules...")
    with engine.connect() as connection:
        print("- Removing rule consequents...")
        connection.execute(text("DELETE FROM RULE_CONSEQUENT_CAT"))
        print("- Removing rule antecedents...")
        connection.execute(text("DELETE FROM RULE_ANTECEDENT_CAT"))
        print("- Removing association rules...")
        connection.execute(text("DELETE FROM ASSOCIATION_RULE_CAT"))
        connection.commit()
        print("Successfully cleared all existing category rules.")

# ===== Analyse-Funktionen =====
def process_transactions(df):
    """
    Verarbeitet die Transaktionsdaten für die Assoziationsanalyse.
    
    Args:
        df: DataFrame mit Transaktionsdaten
    
    Returns:
        DataFrame: Encodierte Transaktionsdaten
    """
    print("\nStep 3: Processing transaction data...")
    print("Grouping transactions by shopping cart...")
    transactions = df.groupby('shopping_cart_id')['product_category_id'].apply(list).tolist()
    print(f"Found {len(transactions)} unique transaction groups")

    print("Encoding transactions...")
    te = TransactionEncoder()
    te_ary = te.fit(transactions).transform(transactions)
    return pd.DataFrame(te_ary, columns=te.columns_)

def generate_association_rules(df_encoded):
    """
    Generiert Assoziationsregeln mittels Apriori-Algorithmus.
    
    Args:
        df_encoded: DataFrame mit encodierten Transaktionen
    
    Returns:
        DataFrame: Generierte Assoziationsregeln
    """
    print("\nStep 4: Generating association rules...")
    print("Applying Apriori algorithm (min_support=0.05)...")
    frequent_itemsets = apriori(df_encoded, min_support=0.05, use_colnames=True)
    print(f"Found {len(frequent_itemsets)} frequent itemsets")

    print("Generating association rules (min_confidence=0.2)...")
    rules = association_rules(frequent_itemsets, metric="confidence", min_threshold=0.2)
    rules = rules[rules['lift'] > 1]
    print(f"Generated {len(rules)} valid rules (lift > 1)")
    
    return rules

def insert_category_rules_to_db(rules, engine):
    """
    Speichert die generierten Kategorieregeln in der Datenbank.
    
    Args:
        rules: DataFrame mit Assoziationsregeln
        engine: SQLAlchemy Engine-Instanz
    """
    print(f"\nStep 5: Storing {len(rules)} category rules in database...")
    
    with engine.connect() as connection:
        clear_existing_category_rules(engine)
        
        for idx, rule in rules.iterrows():
            # Hauptregel einfügen
            rule_id = idx + 1
            connection.execute(
                text("""INSERT INTO ASSOCIATION_RULE_CAT 
                    (ASSOCIATION_RULE_CAT_ID, LIFT, CONFIDENCE, SUPPORT) 
                    VALUES (:id, :lift, :confidence, :support)"""),
                {
                    "id": rule_id,
                    "lift": float(rule['lift']),
                    "confidence": float(rule['confidence']),
                    "support": float(rule['support'])
                }
            )

            # Bedingungen (Antecedents) einfügen
            for ant_idx, cat_id in enumerate(list(rule['antecedents'])):
                connection.execute(
                    text("""INSERT INTO RULE_ANTECEDENT_CAT 
                        (ASSOCIATION_RULE_CAT_ID, RULE_ANTECEDENT_CAT_ID, PRODUCT_CATEGORY_ID) 
                        VALUES (:rule_id, :ant_id, :cat_id)"""),
                    {
                        "rule_id": rule_id,
                        "ant_id": (rule_id * 1000) + ant_idx + 1,
                        "cat_id": int(cat_id)
                    }
                )

            # Folgerungen (Consequents) einfügen
            for cons_idx, cat_id in enumerate(list(rule['consequents'])):
                connection.execute(
                    text("""INSERT INTO RULE_CONSEQUENT_CAT 
                        (ASSOCIATION_RULE_CAT_ID, RULE_CONSEQUENT_CAT_ID, PRODUCT_CATEGORY_ID) 
                        VALUES (:rule_id, :cons_id, :cat_id)"""),
                    {
                        "rule_id": rule_id,
                        "cons_id": (rule_id * 1000) + cons_idx + 1,
                        "cat_id": int(cat_id)
                    }
                )
        
        print("Committing changes to database...")
        connection.commit()
    print("Successfully stored all category rules!")

def main():
    """Hauptfunktion zur Durchführung der Kategorieanalyse."""
    print("\n=== Category Association Rule Mining System ===")
    print("Initializing analysis process...")
    
    # Datenbankverbindung und Daten laden
    engine = get_db_connection()
    df = fetch_transaction_data()
    
    # Datenverarbeitung und Regelgenerierung
    df_encoded = process_transactions(df)
    rules = generate_association_rules(df_encoded)
    
    # Ergebnisse anzeigen
    print("\nAssociation Rules Summary:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']].to_string())
    
    # Regeln in Datenbank speichern
    insert_category_rules_to_db(rules, engine)
    
    print("\nCategory analysis completed successfully!")
    print("==========================================")

if __name__ == "__main__":
    main()