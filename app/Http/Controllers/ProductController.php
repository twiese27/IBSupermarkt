<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductRecommendation;
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

        // Start similar Products
            // Hole das aktuelle Produkt mit ID = 420
            $currentProduct = Product::where('product_id', $productId)->first();

            if (!$currentProduct) {
                return collect(); // Falls das Produkt nicht existiert, leere Collection zurückgeben
            }

            $currentProductName = strtolower($currentProduct->product_name);
            $categoryId = $currentProduct->product_category_id;

            // Generiere Zeichenfolgen (Substrings der Länge 5 aus dem Produktnamen)
            $substrings = [];
            for ($i = 0; $i <= strlen($currentProductName) - 5; $i++) {
                $substrings[] = substr($currentProductName, $i, 5);
            }

            $similarProducts = Product::where('product_category_id', $categoryId)
                ->where('product_id', '!=', $productId)
                ->where(function ($query) use ($substrings) {
                    foreach ($substrings as $substring) {
                        $query->orWhereRaw("LOWER(product_name) LIKE ?", ["%$substring%"]);
                    }
                })
                ->get();
        // End similar Products

        // Start Customers Also Bought
            $consequentIds = ProductRecommendation::where('antecedent_id', $productId)->pluck('consequent_id');
           
            $customersAlsoBought = collect(); // Leere Collection als Fallback
            if ($consequentIds->isNotEmpty()) {
                $customersAlsoBought = Product::whereIn('product_id', $consequentIds)->inRandomOrder()->get();
            }
            
        // End Customers Also Bought

        // Start ecofriendly Products
            if ($product->recyclable_package == 0){

                // Extrahiere mögliche Zeichenfolgen aus dem Produktnamen für den Vergleich
                $produktName = $product->product_name;
                $patternChunks = [];
                $length = mb_strlen($produktName, 'UTF-8');

                for ($i = 0; $i <= $length - 5; $i++) {
                $patternChunks[] = mb_strtolower(mb_substr($produktName, $i, 5, 'UTF-8'));
                }

                // Baue die Query auf
                $ecofriendlyProducts = Product::where('product_category_id', $product->product_category_id)
                ->where('recyclable_package', 1)
                ->where('producer_id', '<>', $product->producer_id)
                ->where(function ($query) use ($patternChunks) {
                    foreach ($patternChunks as $chunk) {
                        $query->orWhereRaw('LOWER(product_name) LIKE ?', ["%{$chunk}%"]);
                    }
                })
                ->limit(10)
                ->get();   
            } else {
                $ecofriendlyProducts = null;
            }
        // End ecofriendly Products
        return view('shop-single', ['products' => $products,
            'product' => $product,
            'category' => $category,
            'producer' => $producer,
            'similarProducts' => $similarProducts,
            'customersAlsoBought' => $customersAlsoBought,
            'ecofriendlyProducts' => $ecofriendlyProducts]);
    }

    protected function checkForSqlInjections($variable) {
        if (empty($variable) || is_numeric($variable) || is_string($variable)) {
            $variable = preg_replace('/[^a-zA-Z0-9\s]/', '', $variable);
            $variable = addslashes($variable);
            return true;
        }
        return false;
    }

    public function search(Request $request){
        {
            $query = $request->input('search');

            if($this->checkForSqlInjections($query) == false){
                return view('index');
            }

            $productsFromProducerName = Product::join('producer', 'product.producer_id', '=', 'producer.producer_id')
                ->whereRaw('LOWER(producer.name) LIKE LOWER(?)', ["%{$query}%"])
                ->select('product.*')
                ->get() 
                ->sortByDesc('product_id');

            $productFromProductName = Product::whereRaw('LOWER(product.product_name) LIKE LOWER(?)', ["%{$query}%"])
                ->select('product.*')
                ->get()
                ->sortByDesc('product_id');

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
                ->get()
                ->sortByDesc('product_id');

            $products = $productsFromProducerName
                ->merge($productFromProductName)
                ->merge($productsFromCategoryName)
                ->unique('product_id')
                ->sortByDesc('product_id')
                ->values();

            $page = request()->input('page', 1);
            $perPage = 16;

            $paginatedProducts = new LengthAwarePaginator(
                $products->forPage($page, $perPage),
                $products->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('searchResults', ['products' => $paginatedProducts, 'query' => $query]);
        }
    }
}
