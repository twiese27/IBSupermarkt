from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine
from sqlalchemy.sql import text
from memory_profiler import profile

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
    # Load transaction data from the Oracle database in chunks for optimization
    engine = get_db_connection()
    query = """
        SELECT SHOPPING_CART_ID, PRODUCT_ID 
        FROM PRODUCT_TO_SHOPPING_CART
    """
    chunks = pd.read_sql(query, engine, chunksize=10000)
    df = pd.concat(chunks, ignore_index=True)
    return df

def clear_existing_rules(engine):
    """Clear all existing rules from the database tables"""
    with engine.connect() as connection:
        # Delete in reverse order to respect foreign key constraints
        connection.execute(text("DELETE FROM RULE_CONSEQUENT"))
        connection.execute(text("DELETE FROM RULE_ANTECEDENT"))
        connection.execute(text("DELETE FROM ASSOCIATION_RULE"))
        connection.commit()

def insert_rules_to_db(rules, engine):
    """Insert association rules into the database"""
    print("Inserting rules into database...")
    
    with engine.connect() as connection:
        # Clear existing rules first
        clear_existing_rules(engine)
        
        # Insert rules and their components
        for idx, rule in rules.iterrows():
            # Insert main rule
            result = connection.execute(
                text("INSERT INTO ASSOCIATION_RULE (ASSOCIATION_RULE_ID) VALUES (:id)"),
                {"id": idx + 1}
            )
            rule_id = idx + 1

            # Insert antecedents
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

            # Insert consequents
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
        
        connection.commit()
    print("Database insertion complete.")

def main():
    # Get database connection
    engine = get_db_connection()
    
    # Fetch data
    df = fetch_transaction_data()
    df.columns = [col.upper() for col in df.columns]

    # Transform data into a format suitable for association rule mining
    transactions = df.groupby('SHOPPING_CART_ID')['PRODUCT_ID'].apply(list).tolist()

    # Encode transactions for analysis
    print("Encoding data for association analysis...")
    te = TransactionEncoder()
    te_ary = te.fit(transactions).transform(transactions)
    df_encoded = pd.DataFrame(te_ary, columns=te.columns_)

    # Apply Apriori algorithm to find frequent itemsets
    print("Applying Apriori algorithm with min_support=0.02...")
    frequent_itemsets = apriori(df_encoded, min_support=0.02, use_colnames=True)

    # Generate association rules
    print("Generating association rules with confidence >= 0.2...")
    rules = association_rules(frequent_itemsets, metric="confidence", min_threshold=0.2)

    # Display results ordered by support
    print("Frequent Itemsets:")
    print(frequent_itemsets.sort_values(by='support', ascending=False))

    print("\nAssociation Rules:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']].sort_values(by='support', ascending=False))

    # After generating rules, insert them into the database
    insert_rules_to_db(rules, engine)
    
    print("Analysis and database update complete.")

if __name__ == "__main__":
    main()