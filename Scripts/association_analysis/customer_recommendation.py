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

# 2. Produktempfehlungen abrufen
print("Querying product recommendations...")
recommendations_query = """
    SELECT 
        pr.ANTECEDENT_ID,
        pr.CONSEQUENT_ID,
        pr.RECOMMENDATION_SCORE
    FROM PRODUCT_RECOMMENDATION pr
    WHERE pr.RECOMMENDATION_SCORE > 1
    ORDER BY pr.RECOMMENDATION_SCORE DESC
"""
product_recommendations = pd.read_sql(recommendations_query, engine)
print(f"Fetched {len(product_recommendations)} product recommendations.")

# 3. Empfehlungen berechnen
print("Generating recommendations...")
customer_recommendations = {}  # Dictionary to track unique recommendations per customer
for _, row in customer_purchases.iterrows():
    customer_id = row['customer_id']
    purchased_product = row['product_id']
    
    # Initialize set for this customer if not exists
    if customer_id not in customer_recommendations:
        customer_recommendations[customer_id] = set()
    
    # Find recommendations based on pre-calculated product recommendations
    matching_recommendations = product_recommendations[
        (product_recommendations['antecedent_id'] == purchased_product)
        & ~product_recommendations['consequent_id'].isin(
            customer_purchases[customer_purchases['customer_id'] == customer_id]['product_id']
        )
    ]
    
    for _, rec in matching_recommendations.iterrows():
        customer_recommendations[customer_id].add(rec['consequent_id'])

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