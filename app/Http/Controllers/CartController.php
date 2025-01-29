<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductToShoppingCart;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        // Build a small list of items from the session-based cart
        $items = [];
        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = (object) [
                    'product' => $product,
                    'total_amount' => $qty,
                ];
            }
        }
        return view('cart', compact('items'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session('cart', []);
        if (!isset($cart[$productId])) {
            $cart[$productId] = 0;
        }
        $cart[$productId]++;
        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function show($id)
    {
        $items = ProductToShoppingCart::where('shopping_cart_id', $id)
            ->with('product')
            ->get();
        return view('cart', compact('items'));
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);
        $cart = session('cart', []);
        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantity;
            }
        }
        session(['cart' => $cart]);
        return redirect()->back();
    }
}
