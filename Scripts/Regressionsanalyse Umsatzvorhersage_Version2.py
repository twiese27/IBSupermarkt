import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sklearn.model_selection import train_test_split
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

def load_data():
    query_2023 = """
    WITH Letztes_Kaufdatum AS (
        SELECT MAX(CREATED_ON) AS LetztesKaufdatum
        FROM SHOPPING_CART
        WHERE DELETED_ON IS NULL
    ), 
    Umsatz AS (
        SELECT ptsc.shopping_cart_id, SUM(p.retail_price) AS Umsatz
        FROM product p
        JOIN product_to_shopping_cart ptsc ON ptsc.product_id = p.product_id
        GROUP BY ptsc.shopping_cart_id
    )
    SELECT 
        sc.CUSTOMER_ID,
        COUNT(DISTINCT sc.SHOPPING_CART_ID) AS Kaufhaeufigkeit,
        COALESCE(SUM(u.Umsatz), 0) AS Gesamtumsatz,
        ROUND(COALESCE(SUM(u.Umsatz) / NULLIF(COUNT(DISTINCT sc.SHOPPING_CART_ID), 0), 0), 2) AS Durchschnittlicher_Warenkorbwert,
        FLOOR(MONTHS_BETWEEN(SYSDATE, c.BIRTH_DATE) / 12) AS AGE
    FROM 
        SHOPPING_CART sc
        LEFT JOIN Umsatz u ON sc.SHOPPING_CART_ID = u.SHOPPING_CART_ID
        JOIN CUSTOMER c ON sc.CUSTOMER_ID = c.CUSTOMER_ID
        CROSS JOIN Letztes_Kaufdatum lkd
    WHERE 
        sc.DELETED_ON IS NULL
        --AND sc.CREATED_ON BETWEEN ADD_MONTHS(lkd.LetztesKaufdatum, -12) AND lkd.LetztesKaufdatum
        AND sc.CREATED_ON BETWEEN TO_DATE('2023-01-01', 'YYYY-MM-DD') AND TO_DATE('2023-12-31', 'YYYY-MM-DD')
        AND sc.customer_id != 12346838
    GROUP BY 
        sc.CUSTOMER_ID, 
        c.BIRTH_DATE
    ORDER BY
        gesamtumsatz DESC
    """

    query_2022 = """
    WITH Letztes_Kaufdatum AS (
        SELECT MAX(CREATED_ON) AS LetztesKaufdatum
        FROM SHOPPING_CART
        WHERE DELETED_ON IS NULL
    ), 
    Umsatz AS (
        SELECT ptsc.shopping_cart_id, SUM(p.retail_price) AS Umsatz
        FROM product p
        JOIN product_to_shopping_cart ptsc ON ptsc.product_id = p.product_id
        GROUP BY ptsc.shopping_cart_id
    )
    SELECT 
        sc.CUSTOMER_ID,
        COUNT(DISTINCT sc.SHOPPING_CART_ID) AS Kaufhaeufigkeit,
        COALESCE(SUM(u.Umsatz), 0) AS Gesamtumsatz,
        ROUND(COALESCE(SUM(u.Umsatz) / NULLIF(COUNT(DISTINCT sc.SHOPPING_CART_ID), 0), 0), 2) AS Durchschnittlicher_Warenkorbwert,
        FLOOR(MONTHS_BETWEEN(SYSDATE, c.BIRTH_DATE) / 12) AS AGE
    FROM 
        SHOPPING_CART sc
        LEFT JOIN Umsatz u ON sc.SHOPPING_CART_ID = u.SHOPPING_CART_ID
        JOIN CUSTOMER c ON sc.CUSTOMER_ID = c.CUSTOMER_ID
        CROSS JOIN Letztes_Kaufdatum lkd
    WHERE 
        sc.DELETED_ON IS NULL
        --AND sc.CREATED_ON BETWEEN ADD_MONTHS(lkd.LetztesKaufdatum, -12) AND lkd.LetztesKaufdatum
        AND sc.CREATED_ON BETWEEN TO_DATE('2022-01-01', 'YYYY-MM-DD') AND TO_DATE('2022-12-31', 'YYYY-MM-DD')
        AND sc.customer_id != 12346838
    GROUP BY 
        sc.CUSTOMER_ID, 
        c.BIRTH_DATE
    ORDER BY
        gesamtumsatz DESC
    """

    query_2024="""
    WITH Letztes_Kaufdatum AS (
        SELECT MAX(CREATED_ON) AS LetztesKaufdatum
        FROM SHOPPING_CART
        WHERE DELETED_ON IS NULL
    ), 
    Umsatz AS (
        SELECT ptsc.shopping_cart_id, SUM(p.retail_price) AS Umsatz
        FROM product p
        JOIN product_to_shopping_cart ptsc ON ptsc.product_id = p.product_id
        GROUP BY ptsc.shopping_cart_id
    )
    SELECT 
        sc.CUSTOMER_ID,
        COUNT(DISTINCT sc.SHOPPING_CART_ID) AS Kaufhaeufigkeit,
        COALESCE(SUM(u.Umsatz), 0) AS Gesamtumsatz,
        ROUND(COALESCE(SUM(u.Umsatz) / NULLIF(COUNT(DISTINCT sc.SHOPPING_CART_ID), 0), 0), 2) AS Durchschnittlicher_Warenkorbwert,
        FLOOR(MONTHS_BETWEEN(SYSDATE, c.BIRTH_DATE) / 12) AS AGE
    FROM 
        SHOPPING_CART sc
        LEFT JOIN Umsatz u ON sc.SHOPPING_CART_ID = u.SHOPPING_CART_ID
        JOIN CUSTOMER c ON sc.CUSTOMER_ID = c.CUSTOMER_ID
        CROSS JOIN Letztes_Kaufdatum lkd
    WHERE 
        sc.DELETED_ON IS NULL
        --AND sc.CREATED_ON BETWEEN ADD_MONTHS(lkd.LetztesKaufdatum, -12) AND lkd.LetztesKaufdatum
        AND sc.CREATED_ON BETWEEN TO_DATE('2024-01-01', 'YYYY-MM-DD') AND TO_DATE('2024-12-31', 'YYYY-MM-DD')
        AND sc.customer_id != 12346838
    GROUP BY 
        sc.CUSTOMER_ID, 
        c.BIRTH_DATE
    ORDER BY
        gesamtumsatz DESC
    """

    # Daten aus der Datenbank laden
    df_2023 = pd.read_sql_query(query_2023, engine)
    df_2022 = pd.read_sql_query(query_2022, engine)
    df_2024 = pd.read_sql_query(query_2024, engine)
    df = pd.concat([df_2023, df_2022]).reset_index(drop=True)
    return df, df_2024

def preprocess_data(df):
    # === Überprüfe auf fehlende Werte ===
    if df.isnull().any().any():
        print("Warnung: Es gibt fehlende Werte. Diese werden jetzt entfernt.")
        df = df.dropna()  # Entfernen von Zeilen mit fehlenden Werten
    return df

def define_features_and_target(df):
    # === Features und Zielvariable definieren ===
    # Anpassung an die tatsächlichen Spaltennamen
    X = df[
        ['kaufhaeufigkeit', 'durchschnittlicher_warenkorbwert', 'age']]  # Stelle sicher, dass diese Spalten existieren
    y = df['gesamtumsatz']
    return X, y

def train_linear_model(X_train, y_train):
    model = LinearRegression()
    model.fit(X_train, y_train)
    return model

def evaluate_model(y_true, y_pred):
    mae = mean_absolute_error(y_true, y_pred)
    rmse = np.sqrt(mean_squared_error(y_true, y_pred))
    r2 = r2_score(y_true, y_pred)
    return mae, rmse, r2

def make_predictions_and_export(df_2024, model, model_type='linear'):
    customer_features = df_2024[['kaufhaeufigkeit', 'durchschnittlicher_warenkorbwert', 'age']].values

    if model_type == 'linear':
        y_pred = model.predict(customer_features)

    predicted_sales_angepasst = np.maximum(y_pred, 0)
    predicted_sales_df = pd.DataFrame({
        'CUSTOMER_ID': df_2024['customer_id'],
        'predicted_sales': predicted_sales_angepasst
    })

    file_path = r"path_to_export_file.csv"  # Hier den Pfad anpassen
    export_forecast_to_csv(predicted_sales_df, file_path)


def export_forecast_to_csv(df_forecasts, file_path):
    df_forecasts.to_csv(file_path, index=False, encoding="utf-8")
    print(f"CSV-Datei erfolgreich gespeichert unter: {file_path}")


def main():
    df, df_2024 = load_data()
    df = preprocess_data(df)
    X, y = define_features_and_target(df)

    # Daten in Trainings- und Testset aufteilen (80% Training, 20% Test)
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Trainiere das lineare Modell
    print("=== Lineares Modell ===")
    model = train_linear_model(X_train, y_train)
    y_pred_linear = model.predict(X_test)

    # Modelle bewerten
    mae_linear, rmse_linear, r2_linear = evaluate_model(y_test, y_pred_linear)

    print(f"Lineares Modell - MAE: {mae_linear}, RMSE: {rmse_linear}, R²: {r2_linear}")

    # Vorhersagen für 2024
    print("=== Vorhersagen für 2024 (lineares Modell) ===")
    make_predictions_and_export(df_2024, model, model_type='linear')  # Beispiel für lineares Modell

    # Visualisierung
    plt.figure(figsize=(10, 6))
    plt.scatter(y_test, y_pred_linear, color='blue', label="Lineares Modell", alpha=0.7)

    plt.plot([min(y_test), max(y_test)], [min(y_test), max(y_test)], linestyle="--", color="green",
             label="Perfekte Übereinstimmung")
    plt.xlabel("Tatsächlicher Umsatz (€)")
    plt.ylabel("Vorhergesagter Umsatz (€)")
    plt.title("Vergleich der Vorhersagen")
    plt.legend()
    plt.grid(True)
    plt.tight_layout()
    plt.show()


# Hauptfunktion ausführen
if __name__ == "__main__":
    main()


