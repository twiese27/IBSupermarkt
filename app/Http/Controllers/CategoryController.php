<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

        $products = Product::query()
            ->where('product_category_id', '=', $category->product_category_id)
            ->limit(20)
            ->get();

        if ($products->count() < 20) {
            $moreProducts = $this->getProductsFromSubcategories($category, 20 - $products->count());
            $products = $products->merge($moreProducts);
        }

        return view('shop-grid', ['products' => $products, 'categoryName' => $category->name]);
    }

    private function getProductsFromSubcategories(ProductCategory $category, int $remainingCount)
    {
        $products = collect();

        $subcategories = ProductCategory::where('parent_category', $category->product_category_id)->get();

        foreach ($subcategories as $subcategory) {
            $subProducts = Product::query()
                ->where('product_category_id', '=', $subcategory->product_category_id)
                ->limit($remainingCount - $products->count())
                ->get();

            $products = $products->merge($subProducts);

            if ($products->count() < $remainingCount) {
                $moreProducts = $this->getProductsFromSubcategories($subcategory, $remainingCount - $products->count());
                $products = $products->merge($moreProducts);
            }

            if ($products->count() >= $remainingCount) {
                break;
            }
        }

        return $products;
    }
}
