<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SalesLastMonth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    public function index(string $category, Request $request)
    {
        $categoryId = $request->query('categoryId');

        $categoryQuery = ProductCategory::query()->where('name', '=', $category);

        if ($categoryId !== null) {
            $categoryQuery->where('product_category_id', '=', $categoryId);
        }

        try {
            $category = $categoryQuery->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404, 'Kategorie nicht gefunden');
        }

        // Hole alle Produkte der Hauptkategorie (ohne Limit)
        $mainProducts = Product::query()
            ->where('product_category_id', '=', $category->product_category_id)
            ->get();

        // Hole rekursiv alle Produkte aus den Unterkategorien
        $subProducts = $this->getProductsFromSubcategories($category);

        // Zusammenführen beider Collections
        $allProducts = $mainProducts->merge($subProducts);

        // Optional: Sortierung (z.B. nach Datum oder einem anderen Kriterium)
        // $allProducts = $allProducts->sortByDesc('created_at');

        // Paginierung einrichten
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allProducts->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedProducts = new LengthAwarePaginator(
            $currentItems,
            $allProducts->count(),
            $perPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );


        // get trending products
        // Get the trending products sorted by SALES for a specific category
        $topSalesLastMonth = SalesLastMonth::where('product_category_id', $categoryId)
        ->orderByDesc('sales')
        ->limit(20)
        ->get();

        // Manuell Produkt-IDs extrahieren, ohne pluck()
        $productIds = [];
        foreach ($topSalesLastMonth as $sale) {
        $productIds[] = $sale->product_id;
        }

        if (empty($productIds)) {
        $trendingProducts = collect(); // Falls keine IDs gefunden wurden
        } else {
        // Produkte abrufen und in der ursprünglichen Reihenfolge sortieren
        $trendingProducts = Product::whereIn('product_id', $productIds)
            ->get()
            ->sortBy(function ($product) use ($productIds) {
                return array_search($product->product_id, $productIds);
            })->values();

        } 
        return view('shop-grid', ['products' => $paginatedProducts, 'trendingProducts' => $trendingProducts, 'categoryName' => $category->name]);
    }

    private function getProductsFromSubcategories(ProductCategory $category): Collection
    {
        $products = collect();

        // Hole alle Unterkategorien der aktuellen Kategorie
        $subcategories = ProductCategory::where('parent_category', $category->product_category_id)->get();

        foreach ($subcategories as $subcategory) {
            // Alle Produkte der Unterkategorie abrufen (ohne Limit)
            $subProducts = Product::query()
                ->where('product_category_id', '=', $subcategory->product_category_id)
                ->get();

            // Mit der aktuellen Collection zusammenführen
            $products = $products->merge($subProducts);

            // Rekursiver Aufruf, um auch die Produkte weiter untergeordneter Kategorien zu sammeln
            $products = $products->merge($this->getProductsFromSubcategories($subcategory));
        }

        return $products;
    }
}
