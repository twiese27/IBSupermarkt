<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SalesAllTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->limit(20)
            ->get();

        // Start Trending products
            $trendingProducts = Cache::remember('trending_products', 1440, function () {
                $products = collect();
                Product::query()
                    ->select('product.*', 'Sales_Last_Month.SALES')
                    ->join('Sales_Last_Month', 'product.product_id', '=', 'Sales_Last_Month.PRODUCT_ID')
                    ->orderByDesc('Sales_Last_Month.SALES')
                    ->chunk(100, function ($chunk) use ($products) {
                        $products = $products->merge($chunk);
                    });

                return $products->toJson();
            });

            $trendingProducts = collect(json_decode($trendingProducts));
        // Ende Trending products

        // Start Conscious Living Products
            $rrProduct = Product::where('product_name', 'LIKE', '%R&R%')
            ->inRandomOrder()
            ->first();
            
            $vegiProduct = Product::whereIn('product_category_id', [31, 104, 105])
                ->inRandomOrder()
                ->first();
            
            $fruitProduct = Product::where('product_category_id', 9)
                ->inRandomOrder()
                ->first();
            
            $lowFatDairyProduct = Product::select(
                    'product.product_id', 'product.low_fat', 'product.product_category_id', 'product_category.parent_category',
                    'product.cases_per_pallet', 'product.units_per_case', 'product.product_name', 'product.srp', 
                    'product.recyclable_package', 'product.retail_price', 'product.gross_weight', 
                    'product.shelf_width', 'product.producer_id', 'product.sku', 'product.net_weight'
                )
                ->leftJoin('product_category', 'product.product_category_id', '=', 'product_category.product_category_id')
                ->where('product_category.parent_category', 14)
                ->where('product.low_fat', 1)
                ->inRandomOrder()
                ->first();
            
            $tufoProduct = Product::where('product_category_id', 111)
                ->inRandomOrder()
                ->first();
            
            function getDrinkDescendantCategoryIds($drinkParentId) {
                $drinkIds = [];
                $drinkChildren = ProductCategory::where('parent_category', $drinkParentId)
                    ->pluck('product_category_id')
                    ->toArray();
                foreach ($drinkChildren as $drinkChildId) {
                    $drinkIds[] = $drinkChildId;
                    $drinkIds = array_merge($drinkIds, getDrinkDescendantCategoryIds($drinkChildId));
                }
                return $drinkIds;
            }
            
            $drinkCategoryId = 16;
            $drinkCategoryIds = array_merge([$drinkCategoryId], getDrinkDescendantCategoryIds($drinkCategoryId));
            
            $drinkProduct = Product::whereIn('product_category_id', $drinkCategoryIds)
                ->where('recyclable_package', 1)
                ->inRandomOrder()
                ->first();
            
            $paperProduct = Product::select(
                    'product.product_id', 'product.low_fat', 'product.product_category_id', 'product_category.parent_category',
                    'product.cases_per_pallet', 'product.units_per_case', 'product.product_name', 'product.srp', 
                    'product.recyclable_package', 'product.retail_price', 'product.gross_weight', 
                    'product.shelf_width', 'product.producer_id', 'product.sku', 'product.net_weight'
                )
                ->leftJoin('product_category', 'product.product_category_id', '=', 'product_category.product_category_id')
                ->where('product_category.parent_category', 39)
                ->where('product.recyclable_package', 1)
                ->inRandomOrder()
                ->first();
            
            $plasticProduct = Product::select('product.product_id', 'product.low_fat', 'product.product_category_id', 'product_category.parent_category',
                    'product.cases_per_pallet', 'product.units_per_case', 'product.product_name', 'product.srp', 
                    'product.recyclable_package', 'product.retail_price', 'product.gross_weight', 
                    'product.shelf_width', 'product.producer_id', 'product.sku', 'product.net_weight'
                    )
                ->leftJoin('product_category', 'product.product_category_id', '=', 'product_category.product_category_id')
                ->where('product_category.parent_category', 95)
                ->where('product.recyclable_package', 1)
                ->inRandomOrder()
                ->first();
                
            $consciousLivingProducts = collect([
                $rrProduct, 
                $vegiProduct,  
                $fruitProduct, 
                $lowFatDairyProduct, 
                $tufoProduct, 
                $paperProduct,  
                $plasticProduct, 
                $drinkProduct
            ])->flatten()->shuffle();
            
        // End Conscious Living Products

        // Start Bestseller
            $minSales = SalesAllTime::orderBy('sales', 'desc')
            ->limit(20)
            ->pluck('sales')
            ->last();

            // Die entsprechenden Produkt-IDs abrufen
            $newItemIds = SalesAllTime::where('sales', '>=', $minSales)
            ->pluck('product_id')
            ->unique(); // Falls es doppelte Einträge gibt, diese entfernen

            $bestseller = Product::whereIn('product_id', $newItemIds)->inRandomOrder()->get();

            $bestseller = $bestseller->shuffle();
        // End Bestseller
        
        // Start Insider Tip as list
            $salesAllTime = DB::table('product_to_warehouse as ptw')
                ->select('ptw.product_id', DB::raw('SUM(ptw.stock) as total_stock'))
                ->whereIn('ptw.product_id', function($query) {
                    $query->select('product_id')
                        ->from('Sales_Last_Month')
                        ->whereRaw('rownum <= 100');
                })
                ->groupBy('ptw.product_id')
                ->orderBy('total_stock')
                ->get();


            $topStockProducts = $salesAllTime->sortByDesc('total_stock')->take(20);
            $insiderTipIds = $topStockProducts->pluck('product_id')->shuffle();

            $insiderTip = Product::query()
                ->whereIn('product_id', $insiderTipIds->toArray())
                ->get();
        // End Insider Tip as list

        // Start Insider Tip big
            $specialOffer = Product::whereIn('product_id', [32362, 32372, 32373, 32381, 32366])
            ->inRandomOrder()
            ->first();
        // End Insider Tip big

        // Start New Items
            $newProducts = Product::orderBy('product_id', 'desc')->limit(20)->get();
            $newProducts = $newProducts->shuffle();
        // End New Items
        return view('index', compact('products', 'trendingProducts', 'bestseller', 'insiderTip', 'newProducts', 'specialOffer', 'consciousLivingProducts'));
    }

}
