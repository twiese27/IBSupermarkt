<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productId = $request->query('id');

        $product = Product::query()
            ->where('PRODUCT_ID', '=', $productId)
            ->firstOrNew();

        $category = ProductCategory::query()
            ->where('PRODUCT_CATEGORY_ID', '=', $product->product_category_id)
            ->firstOrNew();

        $producer = Producer::query()
            ->where('PRODUCER_ID', '=', $product->producer_id)
            ->firstOrNew();

        $products = Product::query()
            ->limit(20)
            ->get();

        return view('shop-single', ['products' => $products, 'product' => $product, 'category' => $category, 'producer' => $producer]);
    }


    protected function checkForSqlInjections($variable) {
        // Überprüfen, ob die Variable leer ist
        if (empty($variable)) {
            return true;
        }

        // Überprüfen, ob die Variable eine Zahl ist
        if (is_numeric($variable)) {
            return true;
        }

        // Überprüfen, ob die Variable ein String ist
        if (is_string($variable)) {
            // Entfernen von Sonderzeichen und Escape-Zeichen
            $variable = preg_replace('/[^a-zA-Z0-9\s]/', '', $variable);
            $variable = addslashes($variable);

            return true;
        }

        // Die Variable ist nicht sicher
        return false;
    }

    //original and working search: name should be search
    public function searchOG(Request $request){
        $query = $request->input('search');

        // Falls kein Suchbegriff eingegeben wurde, eine leere Paginierung zurückgeben
        if (!$query) {
            $products = new LengthAwarePaginator([], 0, 16);
            return view('shop-grid', ['products' => $products, 'query' => $query]);
        }
        $products = Product::join('producer', 'product.producer_id', '=', 'producer.producer_id')
            ->join('product_category', 'product.product_category_id', '=', 'product_category.product_category_id')
            ->whereRaw('LOWER(product.product_name) LIKE LOWER(?)', ["%{$query}%"])
            ->orWhereRaw('LOWER(producer.name) LIKE LOWER(?)', ["%{$query}%"])
            ->orWhereRaw('LOWER(product_category.name) LIKE LOWER(?)', ["%{$query}%"])
            ->select('product.*')
            ->paginate(16);
        return view('searchResults', ['products' => $products, 'query' => $query]);
    }

    public function search(Request $request){
        {
            $query = $request->input('search');

            // 1️ Auf SQL-Injections prüfen
            if($this->checkForSqlInjections($query) == false){
                return view('index');
            }

            // 2️ Suche nach Herstellername
            $productsFromProducerName = Product::join('producer', 'product.producer_id', '=', 'producer.producer_id')
                ->whereRaw('LOWER(producer.name) LIKE LOWER(?)', ["%{$query}%"])
                ->select('product.*')
                ->get(); // Keine Pagination hier, da wir später alles zusammenfassen

            // 3️ Suche nach Produktname
            $productFromProductName = Product::whereRaw('LOWER(product.product_name) LIKE LOWER(?)', ["%{$query}%"])
                ->select('product.*')
                ->get();

            // 4️ Kategoriesuche inkl. Unterkategorien
            $category = ProductCategory::whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$query}%"])->first();

            $categoryIds = collect();

            if ($category) {
                $categoryIds = DB::select("
                    SELECT product_category_id
                    FROM product_category
                    START WITH product_category_id = ?
                    CONNECT BY PRIOR product_category_id = parent_category
                ", [$category->product_category_id]);

                $categoryIds = collect($categoryIds)->pluck('product_category_id');
            }

            $productsFromCategoryName = Product::whereIn('product_category_id', $categoryIds)
                ->select('product.*')
                ->get();

            // 5️ Produkte zusammenführen & doppelte entfernen
            $products = $productsFromProducerName
                ->merge($productFromProductName)
                ->merge($productsFromCategoryName)
                ->unique('product_id') // Verhindert doppelte Einträge
                ->sortByDesc('product_id') // Sortierung nach product_id absteigend
                ->values();

            // 6️ Manuelle Pagination für Laravel Collection
            $page = request()->input('page', 1); // Aktuelle Seite holen
            $perPage = 16; // Produkte pro Seite

            $paginatedProducts = new LengthAwarePaginator(
                $products->forPage($page, $perPage), // Schneidet die Produkte für die Seite aus
                $products->count(), // Gesamtanzahl der Produkte
                $perPage, // Produkte pro Seite
                $page, // Aktuelle Seite
                ['path' => request()->url(), 'query' => request()->query()] // URL für Pagination-Links
            );

            // 7️ View zurückgeben
            return view('searchResults', ['products' => $paginatedProducts, 'query' => $query]);

        }
    }
}
