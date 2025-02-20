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


        // Bestseller abrufen (Top 20 Verkäufe)
        $bestseller = Cache::remember('bestseller_products', 1440, function () {
            return Product::query()
                ->select('product.*', 'Sales_All_Time.sales')
                ->join('Sales_All_Time', 'product.product_id', '=', 'Sales_All_Time.product_id')
                ->orderByDesc('Sales_All_Time.sales')
                ->limit(20)
                ->inRandomOrder() // Zufällige Reihenfolge für die Auswahl
                ->limit(3) // 3 zufällige Bestseller-Produkte auswählen
                ->get();
        });
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
        // Start Insider Tip
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
        // End Insider Tip

        // Start New Items
            $newProducts = Product::orderBy('product_id', 'desc')->limit(20)->get();
            $newProducts = $newProducts->shuffle();
        // End New Items
        return view('index', compact('products', 'trendingProducts', 'bestseller', 'insiderTip', 'newProducts'));
    }

}
