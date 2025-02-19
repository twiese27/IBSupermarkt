from typing import Dict, List, Set, Tuple
import pandas as pd
import sqlalchemy
from db_connection import get_sqlalchemy_engine

# Minimale Anzahl an Käufen eines Produkts durch einen Kunden
MIN_PURCHASE_COUNT = 3
# Minimaler Empfehlungswert für Produktempfehlungen
MIN_RECOMMENDATION_SCORE = 5

def get_customer_purchases(engine: sqlalchemy.Engine) -> pd.DataFrame:
    """
    Ruft alle Kundenkäufe aus der Datenbank ab.
    Berücksichtigt nur Produkte, die mindestens MIN_PURCHASE_COUNT mal gekauft wurden.
    """
    query = """
        SELECT b.customer_id, a.product_id
        FROM product_to_shopping_cart a
        JOIN shopping_cart b ON a.shopping_cart_id = b.shopping_cart_id
        WHERE b.customer_id IS NOT NULL
        GROUP BY b.customer_id, a.product_id
        HAVING COUNT(a.product_id) >= :min_count
    """
    return pd.read_sql(sqlalchemy.text(query), engine, params={"min_count": MIN_PURCHASE_COUNT})

def get_product_recommendations(engine: sqlalchemy.Engine) -> pd.DataFrame:
    """
    Ruft vorberechnete Produktempfehlungen aus der Datenbank ab.
    Filtert nach Empfehlungen mit einem Score über MIN_RECOMMENDATION_SCORE.
    """
    query = """
        SELECT 
            pr.ANTECEDENT_ID,
            pr.CONSEQUENT_ID,
            pr.RECOMMENDATION_SCORE
        FROM PRODUCT_RECOMMENDATION pr
        WHERE pr.RECOMMENDATION_SCORE > :min_score
        ORDER BY pr.RECOMMENDATION_SCORE DESC
    """
    return pd.read_sql(sqlalchemy.text(query), engine, params={"min_score": MIN_RECOMMENDATION_SCORE})

def generate_customer_recommendations(
    customer_purchases: pd.DataFrame,
    product_recommendations: pd.DataFrame
) -> List[Tuple[int, int]]:
    """
    Generiert personalisierte Produktempfehlungen für jeden Kunden
    basierend auf deren Kaufhistorie und den vorberechneten Produktempfehlungen.
    """
    customer_recommendations: Dict[int, Set[int]] = {}

    for _, row in customer_purchases.iterrows():
        customer_id = row['customer_id']
        purchased_product = row['product_id']
        
        if customer_id not in customer_recommendations:
            customer_recommendations[customer_id] = set()
        
        matching_recommendations = product_recommendations[
            (product_recommendations['antecedent_id'] == purchased_product)
            & ~product_recommendations['consequent_id'].isin(
                customer_purchases[customer_purchases['customer_id'] == customer_id]['product_id']
            )
        ]
        
        for _, rec in matching_recommendations.iterrows():
            customer_recommendations[customer_id].add(rec['consequent_id'])

    return [
        (customer_id, product_id)
        for customer_id, products in customer_recommendations.items()
        for product_id in products
    ]

def save_recommendations(engine: sqlalchemy.Engine, recommendations: List[Tuple[int, int]]) -> None:
    """
    Speichert die generierten Kundenempfehlungen in der Datenbank.
    Löscht zuvor alle bestehenden Empfehlungen.
    """
    delete_query = "DELETE FROM CUSTOMER_RECOMMENDATION"
    insert_query = """
        INSERT INTO CUSTOMER_RECOMMENDATION (customer_recommendation_id, customer_id, suggested_product_id)
        VALUES (:id, :customer_id, :suggested_product_id)
    """

    with engine.begin() as connection:
        print("Deleting existing recommendations...")
        connection.execute(sqlalchemy.text(delete_query))
        
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

def main():
    """Hauptfunktion zur Generierung von Kundenempfehlungen."""
    print("Establishing database connection...")
    engine = get_sqlalchemy_engine()

    print("Fetching customer purchase data...")
    customer_purchases = get_customer_purchases(engine)
    print(f"Found {len(customer_purchases)} customer purchases.")

    print("Fetching product recommendations...")
    product_recommendations = get_product_recommendations(engine)
    print(f"Found {len(product_recommendations)} product recommendations.")

    print("Generating customer recommendations...")
    recommendations = generate_customer_recommendations(customer_purchases, product_recommendations)
    print(f"Generated {len(recommendations)} unique recommendations.")

    save_recommendations(engine, recommendations)
    print("Successfully saved all recommendations!")

if __name__ == "__main__":
    main()