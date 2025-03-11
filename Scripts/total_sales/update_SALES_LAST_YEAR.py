import cx_Oracle
from datetime import datetime

# Verbindung zur Oracle-Datenbank herstellen
dsn_tns = cx_Oracle.makedsn("134.106.62.237", "1521", service_name="dbprak2")
connection = cx_Oracle.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn_tns)

def process_sales_data(start_date, end_date, target_table):
    """
    Führt eine Verkaufsanalyse für den angegebenen Zeitraum aus und speichert sie in der Ziel-Tabelle.

    :param start_date: Startdatum als String im Format 'YYYY-MM-DD'
    :param end_date: Enddatum als String im Format 'YYYY-MM-DD'
    :param target_table: Name der Ziel-Tabelle
    """
    cursor = connection.cursor()
    
    # Dynamische SQL-Abfrage für den angegebenen Zeitraum
    sales_query = f"""
        SELECT
            ptc.Product_ID,
            COALESCE(SUM(ptc.Total_Amount), 0) AS total_count
        FROM Product_To_Shopping_Cart ptc
        JOIN Shopping_Cart sc
            ON ptc.Shopping_Cart_ID = sc.Shopping_Cart_ID
        WHERE sc.CREATED_ON BETWEEN TO_DATE(:start_date, 'YYYY-MM-DD') AND TO_DATE(:end_date, 'YYYY-MM-DD')
        GROUP BY ptc.Product_ID
        ORDER BY total_count ASC
    """
    
    cursor.execute(sales_query, {'start_date': start_date, 'end_date': end_date})
    sales_data = cursor.fetchall()

    if not sales_data:
        print(f"Keine neuen Verkaufsdaten für {target_table} gefunden.")
        return
    
    print(f"{len(sales_data)} Datensätze für {target_table} gefunden. Lösche bestehende Daten...")
    cursor.execute(f"DELETE FROM {target_table}")
    
    print(f"Einfügen der neuen Daten...")
    cursor.executemany(
        f"INSERT INTO {target_table} (PRODUCT_ID, SALES) VALUES (:1, :2)",
        sales_data
    )
    
    connection.commit()
    cursor.close()
    print(f"Daten für {target_table} erfolgreich aktualisiert.")

# Beispielaufruf für den Zeitraum 6.9.2023 - 6.9.2024
process_sales_data('2023-09-06', '2024-09-06', 'SALES_LAST_YEAR')

# Verbindung schließen
connection.close()
