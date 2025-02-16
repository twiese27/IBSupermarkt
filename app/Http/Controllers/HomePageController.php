<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesLastMonth;
use App\Models\ProductToShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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
        return view('index', compact('products', 'user', 'customer', 'trendingProducts'));
    }

}
