<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesLastMonth;
use App\Models\SalesAllTime;
use App\Models\ProductToShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class HomePageController extends Controller
{
    public function index()
    {
        //get random shit products
        $products = Product::query()
            ->limit(20)
            ->get();

        //get the user models
        $user = Auth::user();
        $customer = $user ? $user->customer : null;

        // Get the trending products sorted by SALES
        $topSalesLastMonth = SalesLastMonth::orderByDesc('SALES')
        ->limit(20)
        ->get();

        // Manuell Produkt-IDs extrahieren, ohne pluck()
        $productIds = [];
        foreach ($topSalesLastMonth as $sale) {
            $productIds[] = $sale->product_id;
        }

        if (empty($productIds)) {
            $trendingProducts = collect(); // Falls keine IDs gefunden wurden
        } else {
            // Produkte einzeln abrufen und in richtiger Reihenfolge speichern
            $trendingProducts = [];
            foreach ($productIds as $id) {
                $product = Product::where('product_id', $id)->first(); // Einzelne Query pro Produkt
                if ($product) {
                    $trendingProducts[] = $product;
                }
            }
        }


        // Bestseller abrufen (Top 20 Verkäufe)
        $bestsales = SalesAllTime::orderBy('sales', 'desc')
        ->limit(20)
        ->get();

        // Extrahiere die product_id-Werte
        $bestsalesProductIds = $bestsales->pluck('product_id');

        // Produkte abrufen, die in den Bestseller-IDs sind
        $bestseller = Product::whereIn('product_id', $bestsalesProductIds)
        ->inRandomOrder() // Zufällige Reihenfolge für die Auswahl
        ->limit(3) // 3 zufällige Bestseller-Produkte auswählen
        ->get();

        // Insider Tip
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
        
        $insiderTip = Product::whereIn('product_id', $insiderTipIds->toArray())->get();

        return view('index', compact('products', 'user', 'customer', 'trendingProducts', 'bestseller', 'insiderTip'));
    }

}
