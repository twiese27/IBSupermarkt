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

def get_correlated_products(base_products: List[int], available_products: List[int]) -> List[int]:
    """Generate a list of products with varied correlation probabilities, ensuring no duplicates."""
    result = set()
    
    # Sometimes include the base products
    if random.random() < 0.9:
        result.update(random.sample(base_products, random.randint(1, len(base_products))))
    
    # Add random products with different probabilities
    num_additional = random.randint(1, 8)
    result.update(random.sample(available_products, num_additional))
    
    return list(result)

def insert_shopping_carts(product_ids: List[int], num_carts: int, start_id: int) -> List[int]:
    """
    Insert multiple shopping carts with random products in bulk.
    """
    shopping_cart_ids = []
    
    try:
        print("Establishing database connection for insertion...")
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                start_time = datetime.datetime.now()
                print(f"Start Time: {start_time}")
                
                print("Precomputing available product IDs...")
                available_product_ids = [x for x in range(1, 32382) if x not in product_ids]
                
                print("Caching product prices from PRODUCT table...")
                cursor.execute("SELECT product_id, retail_price FROM PRODUCT")
                product_prices = dict(cursor.fetchall())
                print(f"Cached prices for {len(product_prices)} products.")
                
                print("Generating random datetimes, customer IDs, and employee IDs...")
                random_datetimes = [get_random_datetime() for _ in range(num_carts)]
                random_customer_ids = [random.randint(1, 10100) for _ in range(num_carts)]
                random_employee_ids = [random.randint(104, 108) for _ in range(num_carts)]
                
                carts_data = []
                products_to_cart_data = []
                orders_data = []
                
                for i in range(num_carts):
                    cart_id = start_id + i
                    created_on = random_datetimes[i]
                    customer_id = random_customer_ids[i]
                    
                    # Get correlated products instead of always including base products
                    cart_products = get_correlated_products(product_ids, available_product_ids)
                    amount_of_products = len(cart_products)
                    
                    carts_data.append((cart_id, created_on, amount_of_products, customer_id))
                    shopping_cart_ids.append(cart_id)
                    
                    for prod in cart_products:
                        products_to_cart_data.append((prod, cart_id, random.randint(1, 5)))
                    
                    sum_of_prices = sum(product_prices.get(prod, 0) for prod in cart_products)
                    employee_id = random_employee_ids[i]
                    orders_data.append((cart_id, created_on, cart_id, employee_id, "delivered", sum_of_prices))
                    
                    if i % 500 == 0 and i > 0:
                        print(f"Processed {i} of {num_carts} carts...")
                
                print("Bulk inserting shopping carts...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_CART (SHOPPING_CART_ID, CREATED_ON, AMOUNT_OF_PRODUCTS, CUSTOMER_ID) VALUES (:1, :2, :3, :4)",
                    carts_data
                )
                print("Shopping carts insertion completed.")
                
                print("Bulk inserting product associations...")
                cursor.executemany(
                    "INSERT INTO PRODUCT_TO_SHOPPING_CART (PRODUCT_ID, SHOPPING_CART_ID, TOTAL_AMOUNT) VALUES (:1, :2, :3)",
                    products_to_cart_data
                )
                print("Product associations insertion completed.")
                
                print("Bulk inserting shopping orders...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_ORDER (ORDER_ID, ORDER_TIME, SHOPPING_CART_ID, EMPLOYEE_ID, STATUS, TOTAL_PRICE) VALUES (:1, :2, :3, :4, :5, :6)",
                    orders_data
                )
                print("Shopping orders insertion completed.")
                
                conn.commit()
                end_time = datetime.datetime.now()
                print(f"\nFinished Time: {end_time}")
                print(f"Total Duration: {end_time - start_time}")
                print(f"Average time per cart: {(end_time - start_time).total_seconds() / num_carts:.2f} seconds")
                
    except oracledb.Error as e:
        print(f"ERROR: Database error occurred: {e}")
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
        print("Establishing database connection for deletion...")
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                chunk_size = 1000
                end_id = start_id + num_carts - 1
                print(f"Starting deletion for shopping carts with IDs between {start_id} and {end_id}...")

                start_to_delete = start_id
                while start_to_delete <= end_id:
                    partial_end = min(start_to_delete + chunk_size - 1, end_id)
                    print(f"Deleting range {start_to_delete} to {partial_end}...")
                    
                    cursor.execute(
                        "DELETE FROM PRODUCT_TO_SHOPPING_CART WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                        (start_to_delete, partial_end)
                    )
                    cursor.execute(
                        "DELETE FROM SHOPPING_ORDER WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                        (start_to_delete, partial_end)
                    )
                    cursor.execute(
                        "DELETE FROM SHOPPING_CART WHERE SHOPPING_CART_ID BETWEEN :1 AND :2", 
                        (start_to_delete, partial_end)
                    )
                    
                    start_to_delete = partial_end + 1

                conn.commit()
                print("Deletion completed successfully!")
    except oracledb.Error as e:
        print(f"ERROR: Database error occurred: {e}")

def main():
    product_ids = [29382, 27289, 20007]  # Example product IDs
    num_carts = 4500+4500+4500 # Number of shopping carts to create
    # Original start_id = 176328 
    start_id = 176328  # Starting ID for shopping carts

    print("\n=== Shopping Cart Management System ===")
    usr_input = input("Do you want to create or delete shopping carts? (c/d): ")

    if usr_input == "c":
        print(f"\nPreparing to create {num_carts} shopping carts...")
        created_cart_ids = insert_shopping_carts(product_ids, num_carts, start_id)
        print(f"\nOperation completed: Created {len(created_cart_ids)} shopping carts")
    elif usr_input == "d":
        print(f"\nPreparing to delete {num_carts} shopping carts...")
        delete_shopping_carts(start_id, num_carts)
        print("\nDeletion operation completed")
    else:
        print("\nERROR: Invalid input. Please enter 'c' for creating shopping carts or 'd' for deleting shopping carts.")

if __name__ == "__main__":
    main()



