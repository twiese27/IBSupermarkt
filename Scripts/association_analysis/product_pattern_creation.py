import oracledb
import random
import datetime
from typing import List

def get_db_connection():
    """Establish a connection to the Oracle database."""
    dsn = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=134.106.62.237)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=dbprak2)))"
    return oracledb.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn)

def get_random_datetime():
    start_date = datetime.datetime(2020, 1, 1)
    end_date = datetime.datetime(2024, 9, 6)
    delta = end_date - start_date
    random_days = random.randrange(delta.days + 1)
    random_seconds = random.randrange(86400)
    return start_date + datetime.timedelta(days=random_days, seconds=random_seconds)

def insert_shopping_carts(product_ids: List[int], num_carts: int, start_id: int) -> List[int]:
    """
    Insert multiple shopping carts with random products.
    
    Args:
        product_ids: List of specific product IDs to include
        num_carts: Number of shopping carts to create
        start_id: Starting ID for shopping carts
    
    Returns:
        List of created shopping cart IDs
    """
    shopping_cart_ids = []
    
    try:
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                start_time = datetime.datetime.now()
                print(f"Start Time: {start_time}")

                # Precompute available product IDs
                available_product_ids = [x for x in range(1, 32382) if x not in product_ids]

                for i in range(num_carts):
                    print(f"Inserting shopping cart {i + 1} of {num_carts}")
                    
                    cart_id = start_id + i
                    created_on = get_random_datetime()
                    random_customer_id = random.randint(1, 10103)
                    
                    # Add extra random products
                    num_extra_products = random.randint(1, 5)
                    random_extra_products = random.sample(available_product_ids, num_extra_products)
                    total_products = product_ids + random_extra_products
                    amount_of_products = len(total_products)

                    # Insert shopping cart
                    cursor.execute(
                        "INSERT INTO SHOPPING_CART (SHOPPING_CART_ID, CREATED_ON, AMOUNT_OF_PRODUCTS, CUSTOMER_ID) VALUES (:1, :2, :3, :4)", 
                        (cart_id, created_on, amount_of_products, random_customer_id)
                    )
                    
                    shopping_cart_ids.append(cart_id)
                    
                    # Bulk insert products to shopping cart
                    products_to_insert = [
                        (product_id, cart_id, random.randint(1, 5)) 
                        for product_id in total_products
                    ]
                    
                    cursor.executemany(
                        "INSERT INTO PRODUCT_TO_SHOPPING_CART (PRODUCT_ID, SHOPPING_CART_ID, TOTAL_AMOUNT) VALUES (:1, :2, :3)", 
                        products_to_insert
                    )

                    # Insert shopping order
                    random_employee_id = random.randint(104, 108)
                    cursor.execute(
                        "INSERT INTO SHOPPING_ORDER (ORDER_ID, ORDER_TIME, SHOPPING_CART_ID, EMPLOYEE_ID, STATUS) VALUES (:1, :2, :3, :4, :5)",
                        (cart_id, created_on, cart_id, random_employee_id, "Delivered")
                    )

                # Commit all inserts at once
                conn.commit()

                end_time = datetime.datetime.now()
                print(f"Finished Time: {end_time}, Duration: {end_time - start_time}")

    except oracledb.Error as e:
        print(f"Database error occurred: {e}")
        shopping_cart_ids = []

    return shopping_cart_ids

def delete_shopping_carts(start_id: int, num_carts: int):
    """
    Delete shopping carts within a specified ID range.
    
    Args:
        start_id: Starting ID of shopping carts to delete
        num_carts: Number of shopping carts to delete
    """
    try:
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                end_id = start_id + num_carts - 1
                
                # Delete related products first
                cursor.execute(
                    "DELETE FROM PRODUCT_TO_SHOPPING_CART WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                    (start_id, end_id)
                )

                # Then delete shopping orders
                cursor.execute(
                    "DELETE FROM SHOPPING_ORDER WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                    (start_id, end_id)
                )
                
                # Then delete shopping carts
                cursor.execute(
                    "DELETE FROM SHOPPING_CART WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                    (start_id, end_id)
                )
                
                conn.commit()
    except oracledb.Error as e:
        print(f"Database error occurred: {e}")

def main():
    product_ids = [420, 690]  # Example product IDs
    num_carts = 5   # Number of shopping carts to create
    start_id = 176328  # Starting ID for shopping carts

    usr_input = input("Do you want to create or delete shopping carts? (c/d): ")

    if usr_input == "c":
        created_cart_ids = insert_shopping_carts(product_ids, num_carts, start_id)
        print(f"Created {len(created_cart_ids)} shopping carts")
    elif usr_input == "d":
        delete_shopping_carts(start_id, num_carts)
    else:
        print("Invalid input. Please enter 'c' for creating shopping carts or 'd' for deleting shopping carts.")

if __name__ == "__main__":
    main()



