<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

class CategoryMiddleware
{
    public function handle($request, Closure $next)
    {
//        // Hole die Kategorien und teile sie mit allen Views
//        $categories = $this->buildCategoryTree();
//        View::share('categories', $categories);
//
//        return $next($request);
    }

    private function buildCategoryTree($parentId = null, $depth = 0, $maxDepth = 5)
    {
        if ($depth >= $maxDepth) {
            return [];
        }

        $categories = ProductCategory::query()
            ->where('PARENT_CATEGORY', '=', $parentId)
            ->get();

        $categoryTree = [];

        foreach ($categories as $category) {
            Log::debug('Comparing category:', [
                'PRODUCT_CATEGORY_ID' => $category->PRODUCT_CATEGORY_ID,
                'PARENT_CATEGORY' => $category->PARENT_CATEGORY
            ]);

            if ($category->PRODUCT_CATEGORY_ID === $category->PARENT_CATEGORY) {
                continue;
            }

            $category->children = $this->buildCategoryTree($category->PRODUCT_CATEGORY_ID, $depth + 1, $maxDepth);

            $categoryTree[] = $category;
        }

        return $categoryTree;
    }

}
