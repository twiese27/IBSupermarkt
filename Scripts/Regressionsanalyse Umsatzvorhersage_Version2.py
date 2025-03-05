import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sklearn.model_selection import train_test_split
from sqlalchemy import create_engine, text


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
    """Lädt die Daten aus der Datenbank"""
    #Trainingsdaten aus dem Jahr 2023
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
        AND sc.CREATED_ON BETWEEN TO_DATE('2023-01-01', 'YYYY-MM-DD') AND TO_DATE('2023-12-31', 'YYYY-MM-DD')
        AND sc.customer_id != 12346838
    GROUP BY 
        sc.CUSTOMER_ID, 
        c.BIRTH_DATE
    ORDER BY
        gesamtumsatz DESC
    """

    #Trainingsdaten aus dem Jahr 2022
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

    #Daten für die die Vorhersagen getroffen werden aus dem Jahr 2024
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

def table_exists(engine, table_name):
    """Prüft, ob eine Tabelle in der aktuellen Datenbank existiert."""
    with engine.connect() as connection:
        result = connection.execute(
            text("SELECT COUNT(*) FROM all_tables WHERE table_name = :table"),
            {"table": table_name.upper()}
        )
        return result.scalar() > 0

def insert_dataframe(engine, table_name, df):
    """Fügt einen DataFrame in eine bestehende Tabelle ein."""
    if df.empty:
        print("DataFrame ist leer. Kein Einfügen erforderlich.")
        return

    with engine.connect() as connection:
        transaction = connection.begin()
        try:
            df.to_sql(table_name, con=engine, if_exists='append', index=False)
            transaction.commit()
            print(f"DataFrame erfolgreich in {table_name} eingefügt.")
        except Exception as e:
            transaction.rollback()
            print(f"Fehler beim Einfügen in {table_name}: {e}")

def preprocess_data(df):
    """Überprüft, ob fehlende Werte bei Datensätzen vorhanden sind"""
    if df.isnull().any().any():
        print("Warnung: Es gibt fehlende Werte. Diese werden jetzt entfernt.")
        df = df.dropna()  # Entfernen von Zeilen mit fehlenden Werten
    return df

def define_features_and_target(df):
    """Festlegen der Einfluss- und Zielvariablen"""
    X = df[
        ['kaufhaeufigkeit', 'durchschnittlicher_warenkorbwert', 'age']]
    y = df['gesamtumsatz']
    return X, y

def train_linear_model(X_train, y_train):
    """Trainieren des Linearen Modells anhand der Daten"""
    model = LinearRegression()
    model.fit(X_train, y_train)
    return model

def evaluate_model(y_true, y_pred):
    """Evaluieren des Modells anhand verschiedener Kennzahlen"""
    mae = mean_absolute_error(y_true, y_pred)
    rmse = np.sqrt(mean_squared_error(y_true, y_pred))
    r2 = r2_score(y_true, y_pred)
    return mae, rmse, r2

def make_predictions(df_2024, model):
    """Treffen der Vorhersagewerte für die Daten aus 2024"""
    customer_features = df_2024[['kaufhaeufigkeit', 'durchschnittlicher_warenkorbwert', 'age']].values

    y_pred = model.predict(customer_features)

    #Verhindern von negativen Werten
    predicted_sales_angepasst = np.maximum(y_pred, 0)
    predicted_sales_df = pd.DataFrame({
        'CUSTOMER_ID': df_2024['customer_id'],
        'PREDICTED_SALES': predicted_sales_angepasst,
        'CLUSTER_ID':df_2024['cluster_id']
    })

    return predicted_sales_df

def assign_cluster(df):
    """
    Zuweisen einer Cluster_Id zu jedem Kunden, je nach Umsatzvorehersage

    Kriterien:
    1: > 3000€
    2: > 1000€
    3: > 500€
    4: > 100€
    5: 0-100€

    :param df: DataFrame mit Spalten 'customer_id' und 'predicted_sales'
    :return: DataFrame mit neuer Spalte 'cluster_id'
    """

    def get_cluster(sales):
        if sales > 3000:
            return 1
        elif sales > 1000:
            return 2
        elif sales > 500:
            return 3
        elif sales > 100:
            return 4
        else:
            return 5

    df['cluster_id'] = df['predicted_sales'].apply(get_cluster)
    return df

def main():
    #Daten aus der Datenbank laden und Variablen für das Modell definieren
    df, df_2024 = load_data()
    df = preprocess_data(df)
    X, y = define_features_and_target(df)

    # Daten in Trainings- und Testset aufteilen (80% Training, 20% Test)
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Trainieren des lineare Modells
    model = train_linear_model(X_train, y_train)
    y_pred_linear = model.predict(X_test)

    # Modell bewerten
    mae_linear, rmse_linear, r2_linear = evaluate_model(y_test, y_pred_linear)

    print(f"Lineares Modell - MAE: {mae_linear}, RMSE: {rmse_linear}, R²: {r2_linear}")

    # Vorhersagen des Umsatzes für die Daten aus 2024
    df_2024_features = df_2024[X_train.columns]
    df_2024['predicted_sales'] = model.predict(df_2024_features)
    df_2024 = assign_cluster(df_2024)
    df_2024 = make_predictions(df_2024, model)

    # Vorhersagen in DB einfügen
    if table_exists(engine, "REGRESSION_ANALYSIS"):
        insert_dataframe(engine, "REGRESSION_ANALYSIS", df_2024)

    # Visualisierung, bei Bedarf
    #plt.figure(figsize=(10, 6))
    #plt.scatter(y_test, y_pred_linear, color='blue', label="Lineares Modell", alpha=0.7)

    #plt.plot([min(y_test), max(y_test)], [min(y_test), max(y_test)], linestyle="--", color="green",
    #         label="Perfekte Übereinstimmung")
    #plt.xlabel("Tatsächlicher Umsatz (€)")
    #plt.ylabel("Vorhergesagter Umsatz (€)")
    #plt.title("Vergleich der Vorhersagen")
    #plt.legend()
    #plt.grid(True)
    #plt.tight_layout()
    #plt.show()


# Hauptfunktion ausführen
if __name__ == "__main__":
    main()


