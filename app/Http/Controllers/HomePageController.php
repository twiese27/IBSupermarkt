<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            $insiderTipBig = Product::whereIn('product_id', [32362, 32372, 32373, 32381, 32366])
            ->inRandomOrder()
            ->first();
        // End Insider Tip big

        // Start New Items
            $newProducts = Product::orderBy('product_id', 'desc')->limit(20)->get();
            $newProducts = $newProducts->shuffle();
        // End New Items
        return view('index', compact('products', 'trendingProducts', 'bestseller', 'insiderTip', 'newProducts', 'insiderTipBig'));
    }

}
