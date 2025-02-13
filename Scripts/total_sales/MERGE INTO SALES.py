import cx_Oracle

# Verbindung zur Oracle-Datenbank herstellen
dsn_tns = cx_Oracle.makedsn("134.106.62.237", "1521", service_name="dbprak2")
connection = cx_Oracle.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn_tns)

def table_exists(table_name):
    """Prüft, ob eine Tabelle in der aktuellen Datenbank existiert."""
    cursor = connection.cursor()
    cursor.execute("""
        SELECT COUNT(*) FROM all_tables WHERE table_name = :1
    """, (table_name.upper(),))
    exists = cursor.fetchone()[0] > 0
    cursor.close()
    return exists

def process_sales_data(interval, target_table):
    """
    Führt eine Verkaufsanalyse für den angegebenen Zeitraum aus und speichert sie in der Ziel-Tabelle.

    - interval = '1' MONTH → letzter Monat
    - interval = '12' MONTH → letztes Jahr
    - interval = None → alle Zeiten
    """
    cursor = connection.cursor()

    # Dynamische SQL-Abfrage je nach Zeitraum
    if interval:
        sales_query = f"""
            SELECT
                ptc.Product_ID,
                p.product_category_id,
                COALESCE(SUM(ptc.Total_Amount), 0) AS total_count
            FROM Product_To_Shopping_Cart ptc
            JOIN Shopping_Order so
                ON ptc.Shopping_Cart_ID = so.Shopping_Cart_ID
            JOIN Product p
                ON ptc.Product_ID = p.Product_ID
            WHERE so.Order_Time BETWEEN
                (SELECT MAX(Order_Time) FROM Shopping_Order) - INTERVAL '{interval}' MONTH
                AND (SELECT MAX(Order_Time) FROM Shopping_Order)
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
            JOIN Shopping_Order so
                ON ptc.Shopping_Cart_ID = so.Shopping_Cart_ID
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

    print(f"{len(sales_data)} Datensätze für {target_table} gefunden. Upsert wird durchgeführt...")

    # Temporäre Tabelle definieren
    temp_table = f"TEMP_{target_table}"

    # Temporäre Tabelle nur erstellen, wenn sie nicht existiert
    if not table_exists(temp_table):
        cursor.execute(f"""
            CREATE GLOBAL TEMPORARY TABLE {temp_table}
            ON COMMIT PRESERVE ROWS
            AS SELECT PRODUCT_ID, PRODUCT_CATEGORY_ID, SALES FROM {target_table} WHERE 1=0
        """)

    # Temporäre Tabelle leeren
    cursor.execute(f"TRUNCATE TABLE {temp_table}")

    # Daten in die temporäre Tabelle einfügen
    cursor.executemany(
        f"INSERT INTO {temp_table} (PRODUCT_ID, PRODUCT_CATEGORY_ID, SALES) VALUES (:1, :2, :3)",
        sales_data
    )

    # MERGE INTO für das Upsert
    merge_sql = f"""
        MERGE INTO {target_table} t
        USING {temp_table} s
        ON (t.PRODUCT_ID = s.PRODUCT_ID)
        WHEN MATCHED THEN
            UPDATE SET 
                t.SALES = s.SALES,
                t.PRODUCT_CATEGORY_ID = s.PRODUCT_CATEGORY_ID
        WHEN NOT MATCHED THEN
            INSERT (PRODUCT_ID, PRODUCT_CATEGORY_ID, SALES) 
            VALUES (s.PRODUCT_ID, s.PRODUCT_CATEGORY_ID, s.SALES)
    """
    cursor.execute(merge_sql)

    connection.commit()
    cursor.close()
    print(f"Upsert für {target_table} erfolgreich abgeschlossen.")

# Funktionen für die verschiedenen Zeiträume aufrufen
process_sales_data('1', 'SALES_LAST_MONTH')  # Letzter Monat
process_sales_data('12', 'SALES_LAST_YEAR')  # Letztes Jahr
process_sales_data(None, 'SALES_ALL_TIME')   # Alle Zeiten

# Verbindung schließen
connection.close()
