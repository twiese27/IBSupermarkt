import pandas as pd
import matplotlib.pyplot as plt
import oracledb
from sklearn.linear_model import LinearRegression
from sklearn.preprocessing import PolynomialFeatures
import numpy as np
from statsmodels.graphics.tsaplots import plot_acf, plot_pacf

def get_db_connection():
    """Stellt die Verbindung zur Datenbank her"""
    return oracledb.connect(
        user="ONLINESHOP_PROD",
        password="onlineshop_prod",
        dsn="134.106.62.237:1521/dbprak2"
    )

def close_db_connection(connection):
    """Schließt die Verbindung zur Datenbank"""
    if connection:
        connection.close()

def table_exists(table_name):
    """Prüft, ob eine Tabelle in der aktuellen Datenbank existiert."""
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("""
        SELECT COUNT(*) FROM all_tables WHERE table_name = :1
    """, (table_name.upper(),))
    exists = cursor.fetchone()[0] > 0
    cursor.close()
    close_db_connection(connection)
    return exists

def insert_forecast_results(forecast_df):
    """Fügt die Vorhersage-Daten in die Oracle-Tabelle ein."""
    connection = get_db_connection()
    cursor = connection.cursor()

    if table_exists("TIME_SERIES_ANALYSIS"):

        insert_sql = """
            INSERT INTO TIME_SERIES_ANALYSIS (PRODUCT_ID, FORECAST) 
            VALUES (:1, :2)
        """

        # Konvertiert den DataFrame in eine Liste von Tupeln
        data_to_insert = [tuple(row) for row in forecast_df[['Product_Id', 'Forecast']].values]

        try:
            cursor.executemany(insert_sql, data_to_insert)
            connection.commit()
            print(f"{cursor.rowcount} Zeilen erfolgreich eingefügt.")
        except oracledb.DatabaseError as e:
            print(f"Fehler beim Einfügen der Daten: {e}")
        finally:
            cursor.close()
            close_db_connection(connection)
    else:
        print("Tabelle TIME_SERIES_ANALYSIS existiert nicht.")
        cursor.close()
        close_db_connection(connection)

def get_data():
    """Daten aus der Datenbank holen"""
    # Verbindung herstellen
    connection = get_db_connection()
    cursor = connection.cursor()

    # SQL-Query
    query = """SELECT 
                    p.product_id, 
                    p.product_name, 
                    TRUNC(sc.created_on) AS sale_date,
                    COUNT(p.product_id) AS sales_count,  -- Anzahl der Einkaufswagen, in denen das Produkt enthalten war
                    SUM(ptsc.total_amount) AS total_sold  -- Summe aller verkauften Einheiten des Produkts
                FROM 
                    product p 
                    JOIN product_to_shopping_cart ptsc ON p.product_id = ptsc.product_id 
                    JOIN shopping_cart sc ON ptsc.shopping_cart_id = sc.shopping_cart_id 
                WHERE 
                    TRUNC(sc.created_on) BETWEEN
                      (SELECT MAX(created_on) FROM Shopping_Cart) - INTERVAL '1' MONTH
                       AND (SELECT MAX(created_on) FROM Shopping_Cart)
                GROUP BY 
                    p.product_id, 
                    p.product_name, 
                    TRUNC(sc.created_on) 
                ORDER BY 
                    sale_date DESC, 
                    sales_count DESC"""

    cursor.execute(query)
    results = cursor.fetchall()

    # Verbindung schließen
    close_db_connection(connection)

    # Ergebnisse zurückgeben
    return results

def load_data(result):
    """
    Lädt die Daten aus dem SQL-Ergebnis in ein DataFrame.
    """
    df = pd.DataFrame(result, columns=['Product', 'Product_name', 'Date', 'Sales_Count', 'Total_Sold'])
    df['Date'] = pd.to_datetime(df['Date'])  # Datum konvertieren
    return df

def fill_missing_dates(df, start_date="2024-08-06", end_date="2024-09-06"):
    """
    Erstellt eine vollständige Zeitreihe für jedes Produkt und füllt fehlende Tage mit 0-Werten.
    """
    full_dates = pd.date_range(start=start_date, end=end_date)
    products = df[["Product", "Product_name"]].drop_duplicates()

    # Erstelle eine vollständige Kombination aus Produkten und allen Tagen
    full_grid = pd.MultiIndex.from_product([products["Product"], full_dates], names=["Product", "Date"])
    full_df = pd.DataFrame(index=full_grid).reset_index()

    # Merge mit den echten Daten
    df_filled = full_df.merge(df, on=["Product", "Date"], how="left")

    # Fehlende Werte mit 0 füllen
    df_filled["Total_Sold"] = df_filled["Total_Sold"].fillna(0)

    # Produktnamen wieder hinzufügen
    df_filled = df_filled.merge(products, on="Product", how="left")

    # Ergebnis sortieren
    df_filled.sort_values(by=["Product", "Date"], inplace=True)
    return df_filled

def exponential_smoothing(df, alpha=0.5):
    """
    Wendet exponentielle Glättung auf die Verkaufsdaten für jedes Produkt an und erstellt Vorhersagen für die nächsten Tage.

    :param df: DataFrame mit den Spalten ['Product', 'Date', 'Total_Sold']
    :param alpha: Glättungsfaktor (zwischen 0 und 1)
    :param forecast_days: Anzahl der Tage, für die eine Vorhersage erstellt werden soll
    :return: DataFrame mit den Vorhersagen im Format ['Product', 'Date', 'Wert']
    """

    smoothed_data = {}

    for product in df['Product'].unique():
        product_data = df[df['Product'] == product].sort_values(by='Date')
        smoothed_values = [product_data.iloc[0]['Total_Sold']]

        for t in range(1, len(product_data)):
            smoothed_value = (alpha * product_data.iloc[t]['Total_Sold']) + ((1 - alpha) * smoothed_values[-1])
            smoothed_values.append(smoothed_value)

        smoothed_data[product] = smoothed_values

    return smoothed_data

def generating_forecast(smoothed_data_dict, degree=3, x_value=35):
    """
    Erstellt polynomiale Regression, berechnet Vorhersage für x = 35 und visualisiert die Ergebnisse.

    :param smoothed_data_dict: Dictionary mit Produkt als Schlüssel und geglätteten Werten als Listen
    :param degree: Grad des Polynoms
    :param x_value: Der x-Wert (z.B. Tag 35), für den eine Vorhersage berechnet wird
    :return: DataFrame mit den Vorhersagen für jedes Produkt
    """
    forecast_results = []

    for product, smoothed_data in smoothed_data_dict.items():
        X = np.arange(len(smoothed_data)).reshape(-1, 1)
        y = smoothed_data

        poly = PolynomialFeatures(degree=degree)
        X_poly = poly.fit_transform(X)

        model = LinearRegression()
        model.fit(X_poly, y)

        # Zukunftswert-Vorhersage für x = 35
        x_new = np.array([[x_value]])
        x_new_poly = poly.transform(x_new)
        y_pred = model.predict(x_new_poly)

        # Keine negativen Werte zulassen
        forecast_value = max(y_pred[0], 0)

        forecast_results.append({"Product_Id": product, "Forecast": forecast_value})

        """Visualisierung bei Bedarf möglich"""
        # Plot erstellen
        #future_X = np.arange(len(smoothed_data) + 5).reshape(-1, 1)  # 5 zusätzliche Punkte vorhersagen
        #future_X_poly = poly.transform(future_X)
        #future_y = model.predict(future_X_poly)

        #plt.figure(figsize=(8, 5))
        #plt.plot(X, y, label="Geglättete Werte", color="blue", alpha=0.6)
        #plt.plot(future_X, future_y, label=f"Forecast (Polynom {degree}. Grades)", color="green", linestyle="dashed")
        #plt.scatter(x_value, y_pred, color="red", label=f"Vorhersage für x={x_value}", zorder=3, s=100)

        #plt.title(f"Produkt: {product} - Prognose für Tag {x_value}")
        #plt.xlabel("Zeit")
        #plt.ylabel("Wert")
        #plt.legend()
        #plt.grid(True)
        #plt.show()

    return pd.DataFrame(forecast_results)

#Datenabfrage aus der Datenbank
result = get_data()

#Laden der Daten aus der Datenbank in ein DataFrame
df = load_data(result)

#Auffüllen der fehlenden Tage mit Einträgen mit Null-Werten
df_filled = fill_missing_dates(df)

# Exponentielle Glättung
smoothed_values_dict = exponential_smoothing(df_filled)

# Forecast für Tag 35
df_forecast = generating_forecast(smoothed_values_dict)

#Einfügend der Daten in die Datenbank
if table_exists("TIME_SERIES_ANALYSIS"):
    insert_forecast_results(df_forecast)

