import pandas as pd
import matplotlib.pyplot as plt
import oracledb
from sklearn.linear_model import LinearRegression
from sklearn.preprocessing import PolynomialFeatures
from statsmodels.tsa.arima.model import ARIMA
import numpy as np
from statsmodels.graphics.tsaplots import plot_acf, plot_pacf
import warnings
warnings.filterwarnings("ignore", message="Non-stationary starting autoregressive parameters")


def get_db_connection():
    return oracledb.connect(
        user="ONLINESHOP_PROD",
        password="onlineshop_prod",
        dsn="134.106.62.237:1521/dbprak2"  # Beispiel: "localhost:1521/XEPDB1"
    )

def close_db_connection(connection):
    if connection:
        connection.close()

def table_exists(table_name):
    connection = get_db_connection()
    cursor = connection.cursor()
    """Prüft, ob eine Tabelle in der aktuellen Datenbank existiert."""
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

        # Konvertiere DataFrame in eine Liste von Tupeln
        data_to_insert = [tuple(row) for row in forecast_df[['Product', 'Average_Forecast']].values]


        try:
            cursor.executemany(insert_sql, data_to_insert)  # Mehrere Zeilen auf einmal einfügen
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
    # Verbindung herstellen
    connection = get_db_connection()
    cursor = connection.cursor()

    # SQL-Query (abhängig von der Oracle-Version)
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
    results = cursor.fetchall()  # Ergebnisse nach dem ersten Query abrufen

    # Verbindung schließen
    close_db_connection(connection)

    # Ergebnisse zurückgeben
    return results

def get_data_test():
    connection = get_db_connection()
    cursor = connection.cursor()
    query_einzeln="""SELECT 
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
                       AND p.product_id = 444
                GROUP BY 
                    p.product_id, 
                    p.product_name, 
                    TRUNC(sc.created_on) 
                ORDER BY 
                    sale_date DESC, 
                    sales_count DESC
    """

    cursor.execute(query_einzeln)
    results = cursor.fetchall()
    close_db_connection(connection)
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

def filter_valid_products(df, min_days=14):
    """
    Filtert nur Produkte, die mindestens `min_days` Tage verkauft wurden.
    """
    product_counts = df['Product'].value_counts()
    valid_products = product_counts[product_counts >= min_days].index
    return df[df['Product'].isin(valid_products)]

#ARIMA -START
def forecast_sales(df_filtered, forecast_days=7):
    """
    Erstellt eine ARIMA-Prognose für jedes Produkt über `forecast_days` Tage.
    Gibt die durchschnittlichen Forecasts pro Produkt zurück.
    """
    average_forecasts = {}

    for product in df_filtered['Product'].unique():
        # Daten für das aktuelle Produkt filtern
        product_data = df_filtered[df_filtered['Product'] == product]

        # Falls das Produkt mindestens 14 Werte hat
        if len(product_data) >= 14:
            # Zeitreihe für das Produkt
            sales_series = product_data.set_index('Date')['Total_Sold'].asfreq('D').interpolate()

            # ARIMA-Modell (Beispiel: (1, 1, 0))
            model = ARIMA(sales_series, order=(1, 1, 0))
            model_fit = model.fit()

            # Forecast für die nächsten Tage
            forecast = model_fit.forecast(steps=forecast_days)

            # Durchschnitt des Forecasts berechnen
            average_forecasts[product] = forecast.mean()

    return average_forecasts
def generate_acf_pacf(df, num_products=10):
    """
    Berechnet und plottet ACF und PACF für die ersten `num_products` Produkte.
    Die Anzahl der Lags wird dynamisch basierend auf der Anzahl der Datenpunkte angepasst.
    """
    # Wir gehen davon aus, dass df eine Zeitreihe pro Produkt enthält
    unique_products = df['Product'].unique()[:num_products]  # Begrenzung auf die ersten `num_products` Produkte

    for product in unique_products:
        product_data = df[df['Product'] == product]

        # Um sicherzustellen, dass wir eine Zeitreihe haben, setzen wir das Datum als Index
        product_data.set_index('Date', inplace=True)

        # Überprüfe, ob es genug Daten gibt, um ACF und PACF zu berechnen
        if len(product_data) >= 14:
            # Berechne die maximal zulässige Anzahl von Lags (50% der Anzahl der Datenpunkte)
            max_lags = len(product_data) // 2  # max 50% der Datenpunkte als Lags

            # Falls mehr als 20 Lags erforderlich sind, setze die Lags auf den kleineren Wert
            lags = min(max_lags, 20)

            # ACF und PACF berechnen und plotten
            plt.figure(figsize=(12, 6))

            plt.subplot(121)
            plot_acf(product_data['Total_Sold'], lags=lags, ax=plt.gca())
            plt.title(f"ACF für Produkt {product}")

            plt.subplot(122)
            plot_pacf(product_data['Total_Sold'], lags=lags, ax=plt.gca())
            plt.title(f"PACF für Produkt {product}")

            plt.tight_layout()
            plt.show()
#ARIMA -ENDE

def simple_moving_average_forecast(df, forecast_days=7, window=7):
    """
    Erstellt eine Vorhersage basierend auf dem einfachen Durchschnitt der letzten X Tage.

    :param df: DataFrame mit den Spalten ['Product', 'Date', 'Total_Sold']
    :param forecast_days: Anzahl der Tage, für die prognostiziert wird
    :param window: Anzahl der Tage, über die der Durchschnitt gebildet wird
    :return: DataFrame mit den Forecasts
    """
    forecasts = []
    average_forecasts = []

    for product in df['Product'].unique():
        product_data = df[df['Product'] == product].copy()
        product_data = product_data.sort_values(by='Date')

        # Calculate the moving average
        product_data['SMA'] = product_data['Total_Sold'].rolling(window=window, min_periods=1).mean()

        # Get the last average value for the forecast
        last_avg = product_data['SMA'].iloc[-1]

        # Create future dates for the forecast
        future_dates = pd.date_range(start=product_data['Date'].max() + pd.Timedelta(days=1), periods=forecast_days)
        forecast_df = pd.DataFrame({'Product': product, 'Date': future_dates, 'Forecast': last_avg})

        forecasts.append(forecast_df)

        # Append the average forecast for this product
        average_forecasts.append({'Product': product, 'Average_Forecast': last_avg})

    # Combine all forecasts into a single DataFrame
    all_forecasts = pd.concat(forecasts, ignore_index=True)

    # Create a DataFrame for average forecasts per product
    df_average_forecasts = pd.DataFrame(average_forecasts)

    return df_average_forecasts

def exponential_smoothing_forecast(df, alpha=0.5, forecast_days=7):
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

def angepasster_forecast_einzeln(smoothed_data):
    # Features (Zeitpunkte)
    X = np.arange(len(smoothed_data)).reshape(-1, 1)
    y = smoothed_data  # Zielvariable

    # Polynomiale Features erzeugen (z. B. x²)
    degree = 3  # 2. Grad (Parabel)
    poly = PolynomialFeatures(degree=degree)
    X_poly = poly.fit_transform(X)

    # Lineare Regression auf polynomiale Features anwenden
    model = LinearRegression()
    model.fit(X_poly, y)

    # Zukunftswert-Vorhersage
    future_X = np.arange(len(smoothed_data) + 5).reshape(-1, 1)  # 5 Werte vorhersagen
    future_X_poly = poly.transform(future_X)
    future_y = model.predict(future_X_poly)

    # Vorhersage für x = 37 berechnen
    x_new = np.array([[35]])  # Stelle x = 35
    x_new_poly = poly.transform(x_new)  # In polynomiale Features umwandeln
    y_pred = model.predict(x_new_poly)  # Vorhersage berechnen

    print(f"Vorhersage für x = 35: {y_pred[0]:.2f}")

    # Plot der Daten
    #plt.scatter(X, data, label="Originaldaten", color="gray", alpha=0.5)
    #plt.plot(X, smoothed_data, label="Geglättete Daten (EMA)", color="blue")
    #plt.plot(future_X, future_y, label=f"Forecast (Polynom {degree}. Grades)", color="red", linestyle="dashed")
    #plt.legend()
    #plt.xlabel("Zeit")
    #plt.ylabel("Wert")
    #plt.show()

def angepasster_forecast(smoothed_data_dict, degree=3, x_value=35):
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

        # 🔹 Keine negativen Werte zulassen
        forecast_value = max(y_pred[0], 0)

        forecast_results.append({"Product_Id": product, "Forecast": forecast_value})

        # 🔹 Plot erstellen
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


def print_forecast_for_product(df_forecast, product_id):
    """
    Gibt den Forecast für eine bestimmte Produkt-ID aus.

    :param df_forecast: DataFrame mit den Spalten ['Product', 'Date', 'Forecast']
    :param product_id: Die ID des gewünschten Produkts
    """
    product_forecast = df_forecast[df_forecast['Product'] == product_id]

    if product_forecast.empty:
        print(f"Keine Forecast-Daten für Produkt-ID {product_id} gefunden.")
    else:
        print(product_forecast)

def export_forecast_to_csv(df_forecasts, file_path):
    """
    Exportiert die Vorhersagen in eine CSV-Datei.

    :param df_forecasts: DataFrame mit den Spalten ['Product', 'Date', 'Wert']
    :param file_path: Der vollständige Speicherort (Pfad) der CSV-Datei
    """
    df_forecasts.to_csv(file_path, index=False, encoding="utf-8")
    print(f"CSV-Datei erfolgreich gespeichert unter: {file_path}")

result = get_data()
df = load_data(result)
df_filled = fill_missing_dates(df)
# Exponentielle Glättung
smoothed_values_dict = exponential_smoothing_forecast(df_filled)

# Forecast für Tag 35
df_forecast = angepasster_forecast(smoothed_values_dict)

file_path = r"C:\Users\carag\Desktop\average_forecasts.csv"
export_forecast_to_csv(df_forecast, file_path)

