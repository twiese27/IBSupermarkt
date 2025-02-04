<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->limit(20)
            ->get();

        $user = Auth::user();
        $customer = $user ? $user->customer : null;

        $cartItems = session('cart', []);
        $totalCount = 0;
        $productsInCart = [];

        foreach ($cartItems as $prodId => $qty) {
            $totalCount += $qty;
            $product = Product::find($prodId);
            if ($product) {
                $productsInCart[] = "{$qty} x {$product->product_name}";
            }
        }

        return view('index', compact('products', 'user', 'customer', 'totalCount', 'productsInCart'));
    }

}
