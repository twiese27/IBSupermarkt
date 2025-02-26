import cx_Oracle

# Verbindung zur Oracle-Datenbank herstellen
dsn_tns = cx_Oracle.makedsn("134.106.62.237", "1521", service_name="dbprak2")
connection = cx_Oracle.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn_tns)

def process_sales_data(interval, target_table):
    """
    Führt eine Verkaufsanalyse für den angegebenen Zeitraum aus und speichert sie in der Ziel-Tabelle.

    - interval = '1' MONTH → letzter Monat
    - interval = '12' MONTH → letztes Jahr
    - interval = None → alle Zeiten
    """
    cursor = connection.cursor()

    # Tabelle leeren
    cursor.execute(f"DELETE FROM {target_table}")

    # Dynamische SQL-Abfrage je nach Zeitraum
    if interval:
        sales_query = f"""
            SELECT
                ptc.Product_ID,
                p.product_category_id,
                COALESCE(SUM(ptc.Total_Amount), 0) AS total_count
            FROM Product_To_Shopping_Cart ptc
            JOIN Shopping_Cart sc
                ON ptc.Shopping_Cart_ID = sc.Shopping_Cart_ID
            JOIN Product p
                ON ptc.Product_ID = p.Product_ID
            WHERE sc.CREATED_ON BETWEEN
                (SELECT MAX(CREATED_ON) FROM Shopping_Cart) - INTERVAL '{interval}' MONTH
                AND (SELECT MAX(CREATED_ON) FROM Shopping_Cart)
            GROUP BY ptc.Product_ID, p.product_category_id
            ORDER BY total_count ASC
        """
    else:
        # Ohne WHERE-Bedingung für "alle Zeiten"
        sales_query = """
            SELECT
                ptc.Product_ID,
                p.product_category_id,
                COALESCE(SUM(ptc.Total_Amount), 0) AS total_count
            FROM Product_To_Shopping_Cart ptc
            JOIN Shopping_Cart sc
                ON ptc.Shopping_Cart_ID = sc.Shopping_Cart_ID
            JOIN Product p
                ON ptc.Product_ID = p.Product_ID
            GROUP BY ptc.Product_ID, p.product_category_id
            ORDER BY total_count ASC
        """
    
    cursor.execute(sales_query)
    sales_data = cursor.fetchall()

    if not sales_data:
        print(f"Keine neuen Verkaufsdaten für {target_table} gefunden.")
        return

    print(f"{len(sales_data)} Datensätze für {target_table} gefunden. Einfügen der Daten...")

    # Daten in die Zieltabelle einfügen
    cursor.executemany(
        f"INSERT INTO {target_table} (PRODUCT_ID, PRODUCT_CATEGORY_ID, SALES) VALUES (:1, :2, :3)",
        sales_data
    )

    connection.commit()
    cursor.close()
    print(f"Daten für {target_table} erfolgreich aktualisiert.")

# Funktionen für die verschiedenen Zeiträume aufrufen
process_sales_data('1', 'SALES_LAST_MONTH')  # Letzter Monat
process_sales_data('12', 'SALES_LAST_YEAR')  # Letztes Jahr
process_sales_data(None, 'SALES_ALL_TIME')   # Alle Zeiten

# Verbindung schließen
connection.close()
