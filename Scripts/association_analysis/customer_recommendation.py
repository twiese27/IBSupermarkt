import sqlalchemy
from sqlalchemy import create_engine
import pandas as pd

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

print("Connecting to the database...")
engine = get_db_connection()

# 1. Kundenkäufe abrufen
print("Querying customer purchases...")
customer_purchases_query = """
    SELECT b.customer_id, a.product_id
    FROM product_to_shopping_cart a
    JOIN shopping_cart b ON a.shopping_cart_id = b.shopping_cart_id
    WHERE b.customer_id IS NOT NULL
    GROUP BY b.customer_id, a.product_id
    HAVING COUNT(a.product_id) >= 2
"""
customer_purchases = pd.read_sql(customer_purchases_query, engine)
print(f"Fetched {len(customer_purchases)} customer purchases.")

# 2. Antezedenzprodukte abrufen
print("Querying antecedents...")
antecedents_query = """
    SELECT 
        a.association_rule_id, 
        b.product_id AS antecedent, 
        c.product_id AS consequent, 
        b.rule_antecedent_id, 
        c.rule_consequent_id
    FROM association_rule a
    JOIN rule_antecedent b ON a.association_rule_id = b.association_rule_id
    JOIN rule_consequent c ON a.association_rule_id = c.association_rule_id
    WHERE 
        (SELECT COUNT(DISTINCT b2.product_id) 
         FROM rule_antecedent b2 
         WHERE b2.association_rule_id = a.association_rule_id) = 1
"""
antecedents = pd.read_sql(antecedents_query, engine)
print(f"Fetched {len(antecedents)} antecedent items.")

# 3. Empfehlungen berechnen
print("Generating recommendations...")
customer_recommendations = {}  # Dictionary to track unique recommendations per customer
for _, row in customer_purchases.iterrows():
    customer_id = row['customer_id']
    purchased_product = row['product_id']
    
    # Initialize set for this customer if not exists
    if customer_id not in customer_recommendations:
        customer_recommendations[customer_id] = set()
    
    matching_rules = antecedents[
        (antecedents['antecedent'] == purchased_product)
        & ~antecedents['consequent'].isin(
            customer_purchases[customer_purchases['customer_id'] == customer_id]['product_id']
        )
    ]
    
    for _, rule in matching_rules.iterrows():
        customer_recommendations[customer_id].add(rule['consequent'])

# Convert dictionary of sets to list of tuples
recommendations = [
    (customer_id, product_id)
    for customer_id, products in customer_recommendations.items()
    for product_id in products
]
print(f"Generated {len(recommendations)} unique recommendations.")

# 4. Empfehlungen in die Datenbank speichern
print("Saving recommendations to the database...")
delete_query = "DELETE FROM CUSTOMER_RECOMMENDATION"
insert_query = """
    INSERT INTO CUSTOMER_RECOMMENDATION (customer_recommendation_id, customer_id, suggested_product_id)
    VALUES (:id, :customer_id, :suggested_product_id)
"""

with engine.begin() as connection:
    # Delete existing recommendations
    print("Deleting existing recommendations...")
    connection.execute(sqlalchemy.text(delete_query))
    
    # Insert new recommendations
    print(f"Inserting {len(recommendations)} new recommendations...")
    connection.execute(
        sqlalchemy.text(insert_query),
        [
            {
                "id": int(i),
                "customer_id": int(cid),
                "suggested_product_id": int(pid),
            }
            for i, (cid, pid) in enumerate(recommendations, start=1)
        ]
    )

print("Empfehlungen erfolgreich gespeichert!")