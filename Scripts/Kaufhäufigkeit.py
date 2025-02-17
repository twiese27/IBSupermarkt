import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sqlalchemy import create_engine

def get_db_connection():
    """Erstellt eine Verbindung zur Oracle-Datenbank mit SQLAlchemy."""
    user = "ONLINESHOP_PROD"
    password = "onlineshop_prod"
    host = "134.106.62.237"
    port = "1521"
    service_name = "dbprak2"
    dsn = f"oracle+oracledb://{user}:{password}@{host}:{port}/?service_name={service_name}"
    engine = create_engine(dsn)
    return engine

# Verbindung erstellen
engine = get_db_connection()

query = """
WITH Letztes_Kaufdatum AS (
    SELECT MAX(CREATED_ON) AS LetztesKaufdatum
    FROM SHOPPING_CART
    WHERE DELETED_ON IS NULL
)
SELECT 
    c.CUSTOMER_ID,
    COUNT(sc.SHOPPING_CART_ID) AS Kaufhaeufigkeit,
    AVG(sc.AMOUNT_OF_PRODUCTS * p.RETAIL_PRICE) AS Durchschnittlicher_Warenkorbwert,
    FLOOR(MONTHS_BETWEEN(SYSDATE, c.BIRTH_DATE) / 12) AS AGE,
    SUM(sc.AMOUNT_OF_PRODUCTS * p.RETAIL_PRICE) AS Umsatz
FROM 
    SHOPPING_CART sc
    JOIN CUSTOMER c ON sc.CUSTOMER_ID = c.CUSTOMER_ID
    JOIN PRODUCT_TO_SHOPPING_CART scp ON sc.SHOPPING_CART_ID = scp.SHOPPING_CART_ID
    JOIN PRODUCT p ON scp.PRODUCT_ID = p.PRODUCT_ID
    JOIN Letztes_Kaufdatum lkd ON 1 = 1
WHERE 
    sc.DELETED_ON IS NULL
    AND sc.CREATED_ON BETWEEN ADD_MONTHS(lkd.LetztesKaufdatum, -12) AND lkd.LetztesKaufdatum
GROUP BY 
    c.CUSTOMER_ID, 
    c.BIRTH_DATE
"""

# Daten aus der Datenbank laden
df = pd.read_sql_query(query, engine)

# === Datenüberblick ===
print("=== Datenüberblick ===")
print(df.head())  # Überprüfe, ob die Daten korrekt geladen wurden

# === Überprüfe auf fehlende Werte ===
if df.isnull().any().any():
    print("Warnung: Es gibt fehlende Werte. Diese werden jetzt entfernt.")
    df = df.dropna()  # Entfernen von Zeilen mit fehlenden Werten

# === Features und Zielvariable definieren ===
# Anpassung an die tatsächlichen Spaltennamen
X = df[['kaufhaeufigkeit', 'durchschnittlicher_warenkorbwert', 'age']]  # Stelle sicher, dass diese Spalten existieren
y = df['umsatz']

# === Modell erstellen und trainieren ===
model = LinearRegression()
model.fit(X, y)

# === Modellbewertung auf gesamten Daten ===
y_pred = model.predict(X)

# === Modellbewertung und Metriken ausgeben ===
print("\n=== Modellbewertung ===")
print(f"Mean Absolute Error (MAE): {mean_absolute_error(y, y_pred):.2f}")
print(f"Mean Squared Error (MSE): {mean_squared_error(y, y_pred):.2f}")
print(f"Root Mean Squared Error (RMSE): {np.sqrt(mean_squared_error(y, y_pred)):.2f}")
print(f"R²-Wert (Bestimmtheitsmaß): {r2_score(y, y_pred):.2f}")

# === Visualisierung: Streudiagramm der Vorhersagen ===
plt.scatter(y, y_pred, color='blue', label="Daten", alpha=0.7)
plt.plot([min(y), max(y)], [min(y), max(y)], linestyle="--", color="red", label="Perfekte Übereinstimmung")  # Diagonale Linie für perfekte Vorhersage

# Achsenbeschriftung
plt.xlabel("Tatsächlicher Umsatz (€)")
plt.ylabel("Vorhergesagter Umsatz (€)")
plt.title("Regressionsvorhersagen vs. Tatsächliche Werte")
plt.legend()
plt.grid(True)

# Anzeigen der Grafiken
plt.tight_layout()
plt.show()
