<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

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
}
