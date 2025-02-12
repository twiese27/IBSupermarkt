from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine
from sqlalchemy.sql import text

def get_db_connection():
    user = "ONLINESHOP_PROD"
    password = "onlineshop_prod"
    host = "134.106.62.237"
    port = "1521"
    service_name = "dbprak2"

    dsn = f"oracle+oracledb://{user}:{password}@{host}:{port}/?service_name={service_name}"
    engine = create_engine(dsn)
    return engine

def fetch_transaction_data():
    print("\nStep 1: Connecting to database...")
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
    for chunk in pd.read_sql(query, engine, chunksize=10000):
        chunk_count += 1
        print(f"Processing chunk {chunk_count} ({len(chunk)} rows)...")
        chunks.append(chunk)
    
    print(f"Concatenating {chunk_count} chunks...")
    df = pd.concat(chunks, ignore_index=True)
    print(f"Total transactions loaded: {len(df)} rows")
    return df

def clear_existing_category_rules(engine):
    print("\nStep 2: Clearing existing category rules...")
    with engine.connect() as connection:
        print("- Deleting rule consequents...")
        connection.execute(text("DELETE FROM RULE_CONSEQUENT_CAT"))
        print("- Deleting rule antecedents...")
        connection.execute(text("DELETE FROM RULE_ANTECEDENT_CAT"))
        print("- Deleting association rules...")
        connection.execute(text("DELETE FROM ASSOCIATION_RULE_CAT"))
        connection.commit()
        print("All existing category rules cleared successfully.")

def insert_category_rules_to_db(rules, engine):
    print(f"\nStep 5: Inserting {len(rules)} category rules into database...")
    
    with engine.connect() as connection:
        clear_existing_category_rules(engine)
        
        total_rules = len(rules)
        for idx, rule in rules.iterrows():
            # Insert main rule
            connection.execute(
                text("""INSERT INTO ASSOCIATION_RULE_CAT 
                    (ASSOCIATION_RULE_CAT_ID, LIFT, CONFIDENCE, SUPPORT) 
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
            for ant_idx, cat_id in enumerate(antecedents):
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

            # Insert consequents
            consequents = list(rule['consequents'])
            for cons_idx, cat_id in enumerate(consequents):
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
        print("\nCommitting all changes to database...")
        connection.commit()
    print("Category rules insertion completed successfully!")

def main():
    print("\n=== Category Association Rule Mining System ===")
    print("Initializing analysis process...")
    
    engine = get_db_connection()
    df = fetch_transaction_data()
    
    print("\nStep 3: Data Preprocessing")
    print("Grouping transactions by shopping cart...")
    transactions = df.groupby('shopping_cart_id')['product_category_id'].apply(list).tolist()
    print(f"Found {len(transactions)} unique transaction groups")

    print("\nStep 4: Transaction Analysis")
    print("Encoding transactions...")
    te = TransactionEncoder()
    te_ary = te.fit(transactions).transform(transactions)
    print("Creating encoded dataframe...")
    df_encoded = pd.DataFrame(te_ary, columns=te.columns_)

    print("\nApplying Apriori algorithm (min_support=0.05)...")
    frequent_itemsets = apriori(df_encoded, min_support=0.05, use_colnames=True)
    print(f"Found {len(frequent_itemsets)} frequent itemsets")

    print("Generating association rules (min_confidence=0.2)...")
    rules = association_rules(frequent_itemsets, metric="confidence", min_threshold=0.2)
    rules = rules[rules['lift'] > 1]
    print(f"Generated {len(rules)} valid rules (lift > 1)")

    print("\nAssociation Rules Table:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']].to_string())

    # Insert rules into database
    insert_category_rules_to_db(rules, engine)
    
    print("\nCategory analysis completed successfully!")
    print("=======================================")

if __name__ == "__main__":
    main()