# Erweiterte Assoziationsanalyse mit Parameterstudie
from association_analysis_products import fetch_transaction_data as fetch_product_data
from association_analysis_categories import fetch_transaction_data as fetch_category_data
from mlxtend.frequent_patterns import apriori, association_rules
from mlxtend.preprocessing import TransactionEncoder
import pandas as pd
import time
from datetime import datetime
import os

def get_analysis_type():
    """Fragt den Benutzer nach dem gewünschten Analysetyp."""
    while True:
        choice = input("\nWelche Analyse soll durchgeführt werden?\n[P]roducts oder [C]ategories? ").lower()
        if choice in ['p', 'c']:
            return choice

def get_parameter_ranges(analysis_type):
    """Liefert die passenden Parameterbereiche je nach Analysetyp."""
    if analysis_type == 'p':
        return {
            'support': [0.005, 0.01, 0.02, 0.03, 0.05],
            'confidence': [0.1, 0.15, 0.2, 0.25, 0.3, 0.4],
            'lift': [1.0, 1.5, 2.0]
        }
    else:
        return {
            'support': [0.01, 0.02, 0.05, 0.1, 0.15],
            'confidence': [0.1, 0.15, 0.2, 0.3, 0.4, 0.5],
            'lift': [1.0, 1.5, 2.0]
        }

def parameter_study(transaction_matrix, analysis_type):
    """Führt Parameterstudie für Support, Konfidenz und Lift durch."""
    results = {
        'support': [],
        'confidence_by_support': {},
        'lift_by_support_conf': {}
    }
    
    # Parameter je nach Analysetyp wählen
    params = get_parameter_ranges(analysis_type)
    
    print(f"\n=== PARAMETERSTUDIE FÜR {'PRODUKTE' if analysis_type == 'p' else 'KATEGORIEN'} ===")
    
    for s in params['support']:
        # Support-Analyse
        itemsets = apriori(transaction_matrix, min_support=s, use_colnames=True)
        results['support'].append((s, len(itemsets)))
        print(f"\nAnalyse für Support {s}:")
        print(f"- Gefundene Itemsets: {len(itemsets)}")
        
        if len(itemsets) > 0:
            results['confidence_by_support'][s] = []
            results['lift_by_support_conf'][s] = {}
            
            # Konfidenz-Analyse für aktuellen Support
            for c in params['confidence']:
                rules = association_rules(itemsets, metric='confidence', min_threshold=c)
                rules = rules[rules['lift'] > 1]
                results['confidence_by_support'][s].append((c, len(rules)))
                print(f"- Konfidenz {c}: {len(rules)} Regeln")
                
                # Lift-Analyse für aktuelle Support/Konfidenz-Kombination
                results['lift_by_support_conf'][s][c] = []
                for l in params['lift']:
                    filtered = rules[rules['lift'] > l]
                    results['lift_by_support_conf'][s][c].append((l, len(filtered)))
    
    return results

def save_results_to_file(study_results, analysis_type):
    """Speichert die Ergebnisse der Parameterstudie in eine Datei."""
    timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
    filename = f"parameter_study_{'products' if analysis_type == 'p' else 'categories'}_{timestamp}.txt"
    filepath = os.path.join(os.path.dirname(__file__), 'results', filename)
    
    # Ensure results directory exists
    os.makedirs(os.path.dirname(filepath), exist_ok=True)
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(f"=== PARAMETERSTUDIE FÜR {'PRODUKTE' if analysis_type == 'p' else 'KATEGORIEN'} ===\n")
        f.write(f"Durchgeführt am: {datetime.now().strftime('%d.%m.%Y %H:%M:%S')}\n\n")
        
        # Support-Analyse
        f.write("Support-Wirkung (Itemsets):\n")
        f.write("-" * 60 + "\n")
        prev_count = None
        for s, count in study_results['support']:
            diff = f" (Δ{count-prev_count})" if prev_count is not None else ""
            f.write(f"min_support={s:.3f}: {count:3d} Itemsets{diff}\n")
            prev_count = count

        # Konfidenz-Analyse für jeden Support-Wert
        for s in study_results['confidence_by_support']:
            f.write(f"\nKonfidenz-Wirkung bei Support={s:.3f}:\n")
            f.write("-" * 60 + "\n")
            prev_count = None
            for c, count in study_results['confidence_by_support'][s]:
                diff = f" (Δ{count-prev_count})" if prev_count is not None else ""
                f.write(f"min_conf={c:.2f}: {count:3d} Regeln{diff}\n")
                prev_count = count
                
                # Lift-Analyse
                if count > 0:
                    f.write(f"  Lift-Analyse für Support={s:.3f}, Konfidenz={c:.2f}:\n")
                    prev_lift_count = None
                    for l, lift_count in study_results['lift_by_support_conf'][s][c]:
                        diff = f" (Δ{lift_count-prev_lift_count})" if prev_lift_count is not None else ""
                        f.write(f"  lift >{l:.1f}: {lift_count:3d} Regeln{diff}\n")
                        prev_lift_count = lift_count
                    f.write("\n")
    
    print(f"\nErgebnisse gespeichert in: {filepath}")
    return filepath

def main():
    start_time = time.time()
    
    # Analysetyp wählen
    analysis_type = get_analysis_type()
    
    # Daten laden basierend auf Analysetyp
    print("\nLade Transaktionsdaten...")
    if analysis_type == 'p':
        transaction_df = fetch_product_data()
        id_column = 'product_id'
    else:
        transaction_df = fetch_category_data()
        id_column = 'product_category_id'
    
    # Daten vorverarbeiten
    transactions = transaction_df.groupby('shopping_cart_id')[id_column].apply(list).tolist()
    encoder = TransactionEncoder()
    transaction_matrix = pd.DataFrame(encoder.fit_transform(transactions), columns=encoder.columns_)

    # Parameterstudie durchführen
    print("\n=== START PARAMETERSTUDIE ===")
    study_results = parameter_study(transaction_matrix, analysis_type)
    
    # Ergebnisse in Datei speichern
    results_file = save_results_to_file(study_results, analysis_type)
    
    # Ergebnisse auch in der Konsole anzeigen
    print("\n=== ERGEBNISZUSAMMENFASSUNG ===")
    with open(results_file, 'r', encoding='utf-8') as f:
        print(f.read())
    
    print(f"\nGesamtdauer: {time.time()-start_time:.2f}s")

if __name__ == "__main__":
    main()