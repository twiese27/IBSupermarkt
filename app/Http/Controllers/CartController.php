<?php

namespace App\Http\Controllers;

use App\Models\ProductToShoppingCart;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = ProductToShoppingCart::where('shopping_cart_id', 1)
            ->with('product')
            ->get();
        return view('cart', compact('items'));
    }

    public function show($id)
    {
        $items = ProductToShoppingCart::where('shopping_cart_id', $id)
            ->with('product')
            ->get();
        return view('cart', compact('items'));
    }
}
