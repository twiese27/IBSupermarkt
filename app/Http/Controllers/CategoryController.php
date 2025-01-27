<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(string $category, Request $request) {

        $categoryId = $request->query('categoryId');

        $category = ProductCategory::query()
            ->where('name', '=', $category);

        if ($categoryId !== null) {
            $category->where('product_category_id', '=', $categoryId);
        }

        try {
            $category = $category->firstOrFail();
        } catch (ModelNotFoundException $exception) {

        }

        $products = Product::query()
            ->where('product_category_id', '=', $category->product_category_id)
            ->limit(20)
            ->get();

        return view('shop-grid', ['products' => $products]);
    }
}
