from db_connection import get_sqlalchemy_engine
from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine
from sqlalchemy.sql import text

# --- Datenbankoperationen ---

def get_db_connection():
    """Erstellt eine Datenbankverbindung über SQLAlchemy."""
    return get_sqlalchemy_engine()

def fetch_transaction_data():
    """
    Lädt Transaktionsdaten aus der Datenbank in Chunks.
    
    Returns:
        DataFrame: Enthält SHOPPING_CART_ID und PRODUCT_ID aller Transaktionen
    """
    print("Establishing database connection...")
    engine = get_db_connection()
    
    print("Fetching transaction data in chunks...")
    query = """
        SELECT SHOPPING_CART_ID, PRODUCT_ID 
        FROM PRODUCT_TO_SHOPPING_CART
    """
    
    chunks = []
    chunk_count = 0
    for chunk in pd.read_sql(query, engine, chunksize=100000):
        chunk_count += 1
        print(f"Processing chunk {chunk_count} ({len(chunk)} rows)...")
        chunks.append(chunk)
    
    print(f"Merging {chunk_count} chunks...")
    df = pd.concat(chunks, ignore_index=True)
    print(f"Successfully loaded {len(df)} transactions")
    return df

def clear_existing_rules(engine):
    """
    Löscht alle existierenden Assoziationsregeln aus der Datenbank.
    
    Args:
        engine: SQLAlchemy Engine-Instanz
    """
    print("\nClearing existing association rules...")
    with engine.connect() as connection:
        print("- Removing rule consequents...")
        connection.execute(text("DELETE FROM RULE_CONSEQUENT"))
        print("- Removing rule antecedents...")
        connection.execute(text("DELETE FROM RULE_ANTECEDENT"))
        print("- Removing association rules...")
        connection.execute(text("DELETE FROM ASSOCIATION_RULE"))
        connection.commit()
    print("Successfully cleared all existing rules")

def insert_rules_to_db(rules, engine):
    """
    Speichert die generierten Assoziationsregeln in der Datenbank.
    
    Args:
        rules (DataFrame): DataFrame mit den berechneten Assoziationsregeln
        engine: SQLAlchemy Engine-Instanz
    """
    print(f"\nStarting database insertion of {len(rules)} rules...")
    
    with engine.connect() as connection:
        # Bestehende Regeln löschen
        clear_existing_rules(engine)
        
        # Neue Regeln einfügen
        for idx, rule in rules.iterrows():
            # Hauptregel einfügen
            rule_id = idx + 1
            connection.execute(
                text("""INSERT INTO ASSOCIATION_RULE 
                    (ASSOCIATION_RULE_ID, LIFT, CONFIDENCE, SUPPORT) 
                    VALUES (:id, :lift, :confidence, :support)"""),
                {
                    "id": rule_id,
                    "lift": float(rule['lift']),
                    "confidence": float(rule['confidence']),
                    "support": float(rule['support'])
                }
            )

            # Antezedenzien einfügen
            for ant_idx, product_id in enumerate(list(rule['antecedents'])):
                connection.execute(
                    text("""INSERT INTO RULE_ANTECEDENT 
                       (ASSOCIATION_RULE_ID, RULE_ANTECEDENT_ID, PRODUCT_ID) 
                       VALUES (:rule_id, :ant_id, :prod_id)"""),
                    {
                        "rule_id": rule_id,
                        "ant_id": (rule_id * 1000) + ant_idx + 1,
                        "prod_id": int(product_id)
                    }
                )

            # Konsequenzen einfügen
            for cons_idx, product_id in enumerate(list(rule['consequents'])):
                connection.execute(
                    text("""INSERT INTO RULE_CONSEQUENT 
                       (ASSOCIATION_RULE_ID, RULE_CONSEQUENT_ID, PRODUCT_ID) 
                       VALUES (:rule_id, :cons_id, :prod_id)"""),
                    {
                        "rule_id": rule_id,
                        "cons_id": (rule_id * 1000) + cons_idx + 1,
                        "prod_id": int(product_id)
                    }
                )
        
        print("Saving changes to database...")
        connection.commit()
    print("Successfully stored all rules in database")

# --- Hauptprogramm ---

def main():
    """Hauptfunktion für die Durchführung der Assoziationsanalyse."""
    print("\n=== Association Rule Mining System ===")
    
    # Datenbankverbindung initialisieren
    print("Initializing database connection...")
    engine = get_db_connection()
    
    # 1. Daten laden
    print("\nStep 1: Data Collection")
    transaction_df = fetch_transaction_data()
    
    # 2. Daten vorverarbeiten
    print("\nStep 2: Data Preprocessing")
    print("Grouping transactions by shopping cart...")
    transactions = transaction_df.groupby('shopping_cart_id')['product_id'].apply(list).tolist()
    print(f"Found {len(transactions)} unique transactions")

    # 3. Transaktionen kodieren
    print("\nStep 3: Transaction Encoding")
    encoder = TransactionEncoder()
    print("Encoding transactions...")
    encoded_array = encoder.fit(transactions).transform(transactions)
    transaction_matrix = pd.DataFrame(encoded_array, columns=encoder.columns_)

    # 4. Apriori-Algorithmus anwenden
    print("\nStep 4: Applying Apriori Algorithm")
    print("Finding frequent itemsets...")
    frequent_itemsets = apriori(transaction_matrix, min_support=0.01, use_colnames=True)
    print(f"Found {len(frequent_itemsets)} frequent itemsets")

    # 5. Assoziationsregeln generieren
    print("\nStep 5: Generating Association Rules")
    print("Calculating rules...")
    rules = association_rules(frequent_itemsets, metric="confidence", min_threshold=0.25)
    rules = rules[rules['lift'] > 1]  # Nur relevante Regeln behalten
    print(f"Generated {len(rules)} valid rules (lift > 1)")
    
    # Regeln anzeigen
    print("\nAssociation Rules Overview:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']].to_string())

    # 6. Datenbank aktualisieren
    print("\nStep 6: Database Update")
    insert_rules_to_db(rules, engine)
    
    print("\nAssociation analysis completed successfully!")

if __name__ == "__main__":
    main()