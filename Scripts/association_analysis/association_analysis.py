from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
from sqlalchemy import create_engine

def get_db_connection():
    """Erstellt eine Verbindung zur Oracle-Datenbank mit SQLAlchemy."""
    user = "ONLINESHOP_PROD"
    password = "onlineshop_prod"
    host = "134.106.62.237"
    port = "1521"
    service_name = "dbprak2"

    # DSN für SQLAlchemy
    dsn = f"oracle+oracledb://{user}:{password}@{host}:{port}/?service_name={service_name}"

    # SQLAlchemy Engine erstellen
    engine = create_engine(dsn)
    return engine

def fetch_transaction_data():
    """Lädt Transaktionsdaten aus der Oracle-Datenbank mit SQLAlchemy."""
    engine = get_db_connection()
    query = """
        SELECT SHOPPING_CART_ID, PRODUCT_ID 
        FROM PRODUCT_TO_SHOPPING_CART
    """
    df = pd.read_sql(query, engine)  # SQLAlchemy wird hier verwendet
    return df

def main():
    # Daten abrufen
    df = fetch_transaction_data()
    # Make column names uppercase
    df.columns = [col.upper() for col in df.columns]
    print(df.head())  # Zeigt die ersten Zeilen der Daten

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

    # Display results
    print("Frequent Itemsets:")
    print(frequent_itemsets)

    print("\nAssociation Rules:")
    print(rules[['antecedents', 'consequents', 'support', 'confidence', 'lift']])
    print("Analysis complete.")

if __name__ == "__main__":
    main()
