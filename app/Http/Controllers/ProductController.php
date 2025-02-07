<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(Request $request){
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
}
