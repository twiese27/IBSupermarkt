from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine
from sqlalchemy.sql import text

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

def fetch_transaction_data():
    print("Connecting to database...")
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
    
    print(f"Concatenating {chunk_count} chunks...")
    df = pd.concat(chunks, ignore_index=True)
    print(f"Total rows loaded: {len(df)}")
    return df

def clear_existing_rules(engine):
    print("\nClearing existing rules from database...")
    with engine.connect() as connection:
        print("- Deleting rule consequents...")
        connection.execute(text("DELETE FROM RULE_CONSEQUENT"))
        print("- Deleting rule antecedents...")
        connection.execute(text("DELETE FROM RULE_ANTECEDENT"))
        print("- Deleting association rules...")
        connection.execute(text("DELETE FROM ASSOCIATION_RULE"))
        connection.commit()
    print("All existing rules cleared.")

def insert_rules_to_db(rules, engine):
    print(f"\nPreparing to insert {len(rules)} rules into database...")
    
    with engine.connect() as connection:
        clear_existing_rules(engine)
        
        total_rules = len(rules)
        for idx, rule in rules.iterrows():
            # Insert main rule with lift, confidence, and support
            result = connection.execute(
                text("""INSERT INTO ASSOCIATION_RULE 
                    (ASSOCIATION_RULE_ID, LIFT, CONFIDENCE, SUPPORT) 
                    VALUES (:id, :lift, :confidence, :support)"""),
                {
                    "id": idx + 1,
                    "lift": float(rule['lift']),
                    "confidence": float(rule['confidence']),
                    "support": float(rule['support'])
                }
            )
            rule_id = idx + 1

            # Insert antecedents
            antecedents = list(rule['antecedents'])
            for ant_idx, product_id in enumerate(antecedents):
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

            # Insert consequents
            consequents = list(rule['consequents'])
            for cons_idx, product_id in enumerate(consequents):
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
        
        print("\nCommitting all changes...")
        connection.commit()
    print("Database insertion complete.")

def main():
    print("\n=== Association Rule Mining System ===")
    print("Initializing database connection...")
    engine = get_db_connection()
    
    print("\nStep 1: Data Collection")
    df = fetch_transaction_data()
    
    print("\nStep 2: Data Preprocessing")
    print("Grouping transactions by shopping cart...")
    transactions = df.groupby('shopping_cart_id')['product_id'].apply(list).tolist()
    print(f"Found {len(transactions)} unique transactions")

    print("\nStep 3: Transaction Encoding")
    te = TransactionEncoder()
    print("Fitting transaction encoder...")
    te_ary = te.fit(transactions).transform(transactions)
    print("Creating encoded dataframe...")
    df_encoded = pd.DataFrame(te_ary, columns=te.columns_)

    print("\nStep 4: Applying Apriori Algorithm")
    print("Finding frequent itemsets...")
    frequent_itemsets = apriori(df_encoded, min_support=0.01, use_colnames=True)
    print(f"Found {len(frequent_itemsets)} frequent itemsets")

    print("\nStep 5: Generating Association Rules")
    print("Calculating rules...")
    rules = association_rules(frequent_itemsets, metric="confidence", min_threshold=0.25)
    # rules = rules[rules['lift'] > 1]
    print(f"Generated {len(rules)} valid rules (lift > 1)")
    
    print("\nAssociation Rules Table:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']].to_string())

    print("\nStep 6: Database Update")
    insert_rules_to_db(rules, engine)
    
    print("\nAnalysis completed successfully!")

if __name__ == "__main__":
    main()