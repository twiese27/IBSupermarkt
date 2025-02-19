<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\ProductCategory;

class CategoryMiddleware
{
    public function handle($request, Closure $next)
    {
        $categories = $this->getCachedCategories();
        View::share('categories', $categories);

        return $next($request);
    }

    private function getCachedCategories(): array
    {
        $cachedCategories = Cache::remember('categories', 1440, function () {
            $categories = $this->buildCategoryTree();
            return json_encode($categories);
        });

        $categoriesArray = json_decode($cachedCategories, true);
        return $this->arrayToObjects($categoriesArray);
    }

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

    private function arrayToObjects(array $array): array
    {
        return array_map(function ($item) {
            $category = new ProductCategory($item);
            if (isset($item['children'])) {
                $category->children = $this->arrayToObjects($item['children']);
            }
            return $category;
        }, $array);
    }
}
