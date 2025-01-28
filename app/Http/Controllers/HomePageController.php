<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->limit(20)
            ->get();

        $categories = $this->buildCategoryTree();

        return view('index', ['products' => $products, 'categories' => $categories]);
    }

    public function buildCategoryTree($parentId = null, $depth = 0, $maxDepth = 5)
    {
        if ($depth >= $maxDepth) {
            return [];
        }

        $query = ProductCategory::query();

        if ($parentId === null) {
            $query->whereNull('PARENT_CATEGORY');
        } else {
            $query->where('PARENT_CATEGORY', '=', $parentId);
        }

        $categories = $query->get();

        $categoryTree = [];

        foreach ($categories as $category) {
            if ($category->product_category_id === $category->parent_category) {
                continue;
            }

            $category->level = $depth;

            $category->children = $this->buildCategoryTree($category->product_category_id, $depth + 1, $maxDepth);

            $categoryTree[] = $category;
        }

        return $categoryTree;
    }
}
