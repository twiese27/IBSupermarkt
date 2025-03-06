<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductToShoppingCart;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $items = ProductToShoppingCart::query()
                ->select(
                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                    Product::TABLE . '.' . Product::PRODUCT_ID,
                    Product::TABLE . '.' . Product::PRODUCT_NAME,
                    Product::TABLE . '.' . Product::RETAIL_PRICE,
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::TOTAL_AMOUNT
                )
                ->join(
                    ShoppingCart::TABLE,
                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                    '=',
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
                )
                ->join(
                    Product::TABLE,
                    Product::TABLE . '.' . Product::PRODUCT_ID,
                    '=',
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::PRODUCT_ID
                )
                ->where(
                    ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID,
                    '=',
                    $customerId
                )
                ->whereNull(ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'product' => Product::find($item->product_id),
                        'quantity' => $item->total_amount
                    ];
                });
        } else {
            $items = session('cart', []);
//            $items = [];
//
//            foreach ($cart as $productId => $qty) {
//                $product = Product::find($productId);
//                if ($product) {
//                    $items[] = (object) [
//                        'product' => $product,
//                        'quantity' => $qty
//                    ];
//                }
//            }
        }

        return view('cart', compact('items'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Produkt nicht gefunden.'], 404);
        }

        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $shoppingCart = $this->getShoppingCart($customerId);

            if ($shoppingCart->exists) {
                $productToCart = ProductToShoppingCart::query()
                    ->firstOrNew([
                        ProductToShoppingCart::PRODUCT_ID => $productId,
                        ProductToShoppingCart::SHOPPING_CART_ID => $shoppingCart->shopping_cart_id
                    ]);

                $productToCart->total_amount = ($productToCart->exists ? $productToCart->total_amount + 1 : 1);
                $productToCart->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'quantity' => 1,
                    'product' => $product
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'cart' => $cart,
            'totalCount' => array_sum(array_column($cart, 'quantity'))
        ]);
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
        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
        }

        session(['cart' => $cart]);

        $newSubtotal = 0;
        foreach ($cart as $prodId => $qty) {
            $product = Product::find($prodId);
            if ($product) {
                $newSubtotal += $product->retail_price * $qty;
            }
        }

        return response()->json([
            'message' => 'Produktmenge geändert',
            'newSubtotal' => $newSubtotal,
            'session' => $cart
        ]);
    }


    public function getTotalPrice(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);
        $product = \App\Models\Product::find($productId);
        if ($product) {
            $price = $product->retail_price * $quantity;
            return response()->json([
                'price' => $price
            ]);
        } else {
            return response()->json([
                'error' => 'Produkt nicht gefunden'
            ]);
        }
    }

    public function getTotalCartPrice()
    {
        $cart = session('cart', []);

        session(['cart' => $cart]);

        $total = 0;
        foreach ($cart as $prodId => $qty) {
            $product = \App\Models\Product::find($prodId);
            if ($product) {
                $total += $product->retail_price * $qty;
            }
        }

        return response()
            ->json([
                'subtotal' => $total,
                'total' => $total
            ]);
    }

    private function getShoppingCart(int $customerId)
    {
        return ShoppingCart::query()
            ->where(ShoppingCart::CUSTOMER_ID, '=', $customerId)
            ->whereNotNull(ShoppingCart::DELETED_ON)
            ->firstOrNew();
    }
}
