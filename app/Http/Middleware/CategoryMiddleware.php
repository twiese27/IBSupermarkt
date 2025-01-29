<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

class CategoryMiddleware
{
    public function handle($request, Closure $next)
    {
        $categories = $this->buildCategoryTree();
        View::share('categories', $categories);

        return $next($request);
    }

    /**
     * @param int|null $parentId
     * @param int $depth
     * @param int $maxDepth
     * @return array
     */
    private function buildCategoryTree(int $parentId = null, int $depth = 0, int $maxDepth = 5): array
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
