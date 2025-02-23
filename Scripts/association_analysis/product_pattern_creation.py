import random
import datetime
from typing import List
import oracledb
from db_connection import get_oracle_connection

def get_db_connection():
    """Stellt eine Verbindung zur Oracle-Datenbank her."""
    return get_oracle_connection()

def get_random_datetime():
    """
    Generiert ein zufälliges Datum zwischen 2020 und 2024.
    
    Returns:
        datetime: Zufälliges Datum im spezifizierten Zeitraum
    """
    start_date = datetime.datetime(2020, 1, 1)
    end_date = datetime.datetime(2024, 9, 6)
    delta = end_date - start_date
    random_days = random.randrange(delta.days + 1)
    random_seconds = random.randrange(86400)
    return start_date + datetime.timedelta(days=random_days, seconds=random_seconds)

def get_correlated_products(base_products: List[int], available_products: List[int]) -> List[int]:
    """
    Erstellt eine Liste von Produkten mit verschiedenen Assoziationswahrscheinlichkeiten.
    
    Die Funktion implementiert ein Wahrscheinlichkeitsmodell für realistische Einkaufsmuster:
    - 90% Chance für Korrelation mit Basisprodukten
    - 70% Chance für vollständige Übernahme der Basisprodukte
    - Zufällige Anzahl (1-8) zusätzlicher Produkte
    
    Args:
        base_products: Liste der Basis-Produkte
        available_products: Liste der verfügbaren Produkte
    Returns:
        List[int]: Liste der korrelierten Produkte ohne Duplikate
    """
    result = set()
    
    if random.random() < 0.9:
        if random.random() < 0.7:
            result.update(base_products)
        else:
            result.update(random.sample(base_products, random.randint(1, len(base_products))))
    
    num_additional = random.randint(1, 8)
    result.update(random.sample(available_products, num_additional))
    
    return list(result)

def insert_shopping_carts(product_ids: List[int], num_carts: int, start_id: int) -> List[int]:
    """
    Fügt mehrere Einkaufswagen mit zufälligen Produkten in die Datenbank ein.
    
    Args:
        product_ids: Liste der Produkt-IDs für Assoziationsanalyse
        num_carts: Anzahl der zu erstellenden Einkaufswagen
        start_id: Start-ID für die Einkaufswagen
    Returns:
        List[int]: Liste der erstellten Einkaufswagen-IDs
    """
    shopping_cart_ids = []
    
    try:
        print("Establishing database connection for insertion...")
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                start_time = datetime.datetime.now()
                print(f"Start time: {start_time}")
                
                print("Pre-computing available product IDs...")
                available_product_ids = [x for x in range(1, 32382) if x not in product_ids]
                
                print("Caching product prices from PRODUCT table...")
                cursor.execute("SELECT product_id, retail_price FROM PRODUCT")
                product_prices = dict(cursor.fetchall())
                print(f"Cached prices for {len(product_prices)} products.")
                
                print("Generating random timestamps, customer IDs and employee IDs...")
                random_datetimes = [get_random_datetime() for _ in range(num_carts)]
                random_customer_ids = [random.randint(1, 10100) for _ in range(num_carts)]
                # 30% der Einkaufswagen werden einem spezifischen Kunden zugeordnet
                # random_customer_ids = [12346838 if random.random() < 0.3 else random.randint(1, 10100) for _ in range(num_carts)] 
                random_employee_ids = [random.randint(104, 108) for _ in range(num_carts)]
                
                # Vorbereitende Datenlisten für Masseneinfügung
                carts_data = []
                products_to_cart_data = []
                orders_data = []
                cart_extension_data = []
                order_extension_data = []
                
                for i in range(num_carts):
                    cart_id = start_id + i
                    created_on = random_datetimes[i]
                    customer_id = random_customer_ids[i]
                    
                    cart_products = get_correlated_products(product_ids, available_product_ids)
                    amount_of_products = len(cart_products)
                    
                    # Basisdaten für verschiedene Tabellen vorbereiten
                    carts_data.append((cart_id, created_on, amount_of_products, customer_id))
                    shopping_cart_ids.append(cart_id)
                    cart_extension_data.append((cart_id, cart_id, 2))
                    
                    for prod in cart_products:
                        products_to_cart_data.append((prod, cart_id, random.randint(1, 5)))
                    
                    sum_of_prices = sum(product_prices.get(prod, 0) for prod in cart_products)
                    employee_id = random_employee_ids[i]
                    orders_data.append((cart_id, created_on, cart_id, employee_id, "delivered", sum_of_prices))
                    order_extension_data.append((cart_id, cart_id, sum_of_prices, 2, None))
                    
                    if i % 500 == 0 and i > 0:
                        print(f"Processed {i} of {num_carts} shopping carts...")
                
                # Masseneinfügungen durchführen
                print("Performing bulk insert for shopping carts...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_CART (SHOPPING_CART_ID, CREATED_ON, AMOUNT_OF_PRODUCTS, CUSTOMER_ID) VALUES (:1, :2, :3, :4)",
                    carts_data
                )
                
                print("Performing bulk insert for cart extensions...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_CART_EXTENSION (SHOPPING_CART_EXTENSION_ID, SHOPPING_CART_ID, POINT_OF_SALE_ID) VALUES (:1, :2, :3)",
                    cart_extension_data
                )
                
                print("Performing bulk insert for product assignments...")
                cursor.executemany(
                    "INSERT INTO PRODUCT_TO_SHOPPING_CART (PRODUCT_ID, SHOPPING_CART_ID, TOTAL_AMOUNT) VALUES (:1, :2, :3)",
                    products_to_cart_data
                )
                
                print("Performing bulk insert for orders...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_ORDER (ORDER_ID, ORDER_TIME, SHOPPING_CART_ID, EMPLOYEE_ID, STATUS, TOTAL_PRICE) VALUES (:1, :2, :3, :4, :5, :6)",
                    orders_data
                )
                
                print("Performing bulk insert for order extensions...")
                cursor.executemany(
                    "INSERT INTO SHOPPING_ORDER_EXTENSION (SHOPPING_ORDER_EXTENSION_ID, ORDER_ID, NET_PURCHASE_PRICE, POINT_OF_SALE_ID, CASH_REGISTRY_ID) VALUES (:1, :2, :3, :4, :5)",
                    order_extension_data
                )
                
                conn.commit()
                end_time = datetime.datetime.now()
                print(f"\nEnd time: {end_time}")
                print(f"Total duration: {end_time - start_time}")
                print(f"Average time per cart: {(end_time - start_time).total_seconds() / num_carts:.2f} seconds")
                
    except oracledb.Error as e:
        print(f"ERROR: Database operation failed: {e}")
        shopping_cart_ids = []
    
    return shopping_cart_ids

def delete_shopping_carts(start_id: int, num_carts: int):
    """
    Löscht alle Einkaufswagen ab der Start-ID in Batches.
    """
    try:
        print("Establishing database connection for faster batch deletion...")
        with get_db_connection() as conn:
            with conn.cursor() as cursor:
                start_time = datetime.datetime.now()
                print(f"Starting deletion for shopping carts from ID {start_id}...")

                batch_size = 3000
                end_id = start_id + num_carts

                deletion_tables = [
                    ("SHOPPING_ORDER_EXTENSION", "ORDER_ID"),
                    ("SHOPPING_CART_EXTENSION", "SHOPPING_CART_ID"),
                    ("PRODUCT_TO_SHOPPING_CART", "SHOPPING_CART_ID"),
                    ("SHOPPING_ORDER", "ORDER_ID"),
                    ("SHOPPING_CART", "SHOPPING_CART_ID")
                ]

                for table, id_col in deletion_tables:
                    print(f"\nDeleting from {table} in batches...")
                    table_deleted = 0
                    for batch_start in range(start_id, end_id, batch_size):
                        batch_end = min(batch_start + batch_size, end_id)
                        cursor.execute(
                            f"DELETE FROM {table} WHERE {id_col} >= :1 AND {id_col} < :2",
                            (batch_start, batch_end)
                        )
                        count = cursor.rowcount
                        table_deleted += count
                        print(f"  Batch {batch_start}-{batch_end - 1}: {count} rows deleted")
                        conn.commit()

                    print(f"Completed {table}: {table_deleted} total rows deleted.")

                end_time = datetime.datetime.now()
                duration = (end_time - start_time).total_seconds()
                print("\nDeletion completed successfully!")
                print(f"Total duration: {duration:.2f} seconds")

    except oracledb.Error as e:
        print(f"ERROR: Database operation failed: {e}")

def main():
    """
    Hauptfunktion zum Erstellen oder Löschen von Einkaufswagen.
    Verwaltet die Batch-IDs für die verschiedenen Durchläufe.
    """
    product_ids = [32172, 29382, 32361]  # Beispiel-Produkt-IDs für Assoziationsanalyse
    num_carts = 4500  # Gesamtanzahl der Einkaufswagen
    start_id = 176328  # Start-ID für den ersten Batch

    # Batch 1 start_id = 176328 
    # Batch 2 start_id = 189828 
    # Batch 3 start_id = 203328 
    # Batch 4 start_id = 216828 
    # Batch 5 start_id = 230328 
    # End id = 243827
    # Total = 67500

    usr_input = input("Do you want to create or delete shopping carts? (c/d): ")

    if usr_input.lower() == "c":
        print(f"\nPreparing to create {num_carts} shopping carts...")
        print("\nProduct IDs for association analysis:")
        print(product_ids)
        created_cart_ids = insert_shopping_carts(product_ids, num_carts, start_id)
        print(f"\nOperation completed: Created {len(created_cart_ids)} shopping carts")
    elif usr_input.lower() == "d":
        print(f"\nPreparing to delete {num_carts} shopping carts...")
        delete_shopping_carts(start_id, num_carts)
        print("\nDeletion operation completed")
    else:
        print("\nERROR: Invalid input. Please enter 'c' for create or 'd' for delete.")

if __name__ == "__main__":
    main()



