import oracledb
from sqlalchemy import create_engine

def get_oracle_connection():
    """Stellt eine direkte Verbindung zur Oracle-Datenbank her."""
    dsn = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=134.106.62.237)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=dbprak2)))"
    return oracledb.connect(user="ONLINESHOP_PROD", password="onlineshop_prod", dsn=dsn)

def get_sqlalchemy_engine():
    """Erstellt eine SQLAlchemy Engine für die Datenbankverbindung."""
    user = "ONLINESHOP_PROD"
    password = "onlineshop_prod"
    host = "134.106.62.237"
    port = "1521"
    service_name = "dbprak2"

    dsn = f"oracle+oracledb://{user}:{password}@{host}:{port}/?service_name={service_name}"
    return create_engine(dsn)
