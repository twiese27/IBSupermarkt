import cx_Oracle

# Verbindung zur Oracle-Datenbank herstellen
dsn_tns = cx_Oracle.makedsn("134.106.62.237", "1521", service_name="dbprak2")
connection = cx_Oracle.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn_tns)

def create_sales_table():
    """Erstellt die Tabelle SALES_LAST_YEAR, falls sie nicht existiert."""
    cursor = connection.cursor()
    
    create_table_sql = """
        CREATE TABLE SALES_LAST_YEAR (
            SALES_LAST_YEAR_ID NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
            PRODUCT_ID NUMBER NOT NULL,
            SALES NUMBER NOT NULL,
            PRODUCT_CATEGORY_ID NUMBER NOT NULL
        )
    """
    
    try:
        cursor.execute(create_table_sql)
        print("Tabelle SALES_LAST_YEAR erfolgreich erstellt.")
    except cx_Oracle.DatabaseError as e:
        error, = e.args
        if error.code == 955:  # ORA-00955: Name ist bereits vergeben
            print("Tabelle SALES_LAST_YEAR existiert bereits.")
        else:
            print(f"Fehler beim Erstellen der Tabelle: {error.message}")
    
    cursor.close()
    connection.commit()

# Funktion aufrufen
create_sales_table()

# Verbindung schließen
connection.close()
