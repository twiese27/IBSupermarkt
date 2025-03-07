<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductToShoppingCart;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $items = $this->getShoppingCartItems($customerId);
        } else {
            $items = session('cart', collect());

            foreach ($items as $productId => $item) {
                if (!is_object($item)) {
                    $product = Product::find($productId);
                    $items[$productId] = (object) [
                        'quantity' => $item['quantity'],
                        'product' => (object) $product
                    ];
                }
            }
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
                        ProductToShoppingCart::PRODUCT_ID => $product->product_id,
                        ProductToShoppingCart::SHOPPING_CART_ID => $shoppingCart->shopping_cart_id
                    ]);

                if (!$productToCart->exists) {
                    $productToCart->product_id = $product->product_id;
                    $productToCart->shopping_cart_id = $shoppingCart->shopping_cart_id;
                    $this->updateAmountOfProducts($shoppingCart);
                }

                $productToCart->total_amount = ($productToCart->exists ? $productToCart->total_amount + 1 : 1);
                $productToCart->save();
            } else {
                $shoppingCart = $this->createShoppingCart($customerId);

                ProductToShoppingCart::query()
                    ->insert([
                        ProductToShoppingCart::SHOPPING_CART_ID => $shoppingCart->shopping_cart_id,
                        ProductToShoppingCart::PRODUCT_ID => $product->product_id,
                        ProductToShoppingCart::TOTAL_AMOUNT => 1
                    ]);
            }

            $cart = $this->getShoppingCartItems($customerId);
        } else {
            $cart = session()->get('cart', collect());

            if (isset($cart[$productId])) {
                $cart[$productId]->quantity++;
            } else {
                $cart[$productId] = (object) [
                    'quantity' => 1,
                    'product' => (object) $product
                ];
            }

            session()->put('cart', $cart);
        }
        $totalCount = array_sum(array_column($cart->toArray(), 'quantity'));

        return response()->json([
            'cart' => $cart,
            'totalCount' => $totalCount
        ]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $shoppingCart = $this->getShoppingCart($customerId);

            ProductToShoppingCart::query()
                ->where('shopping_cart_id', $shoppingCart->shopping_cart_id)
                ->where('product_id', $productId)
                ->delete();

            ShoppingCart::query()
                ->where(ShoppingCart::SHOPPING_CART_ID, '=', $shoppingCart->shopping_cart_id)
                ->update([ShoppingCart::AMOUNT_OF_PRODUCTS => $shoppingCart->amount_of_products - 1]);
        } else {
            $cart = session('cart', collect());
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
            }
            session(['cart' => $cart]);
        }

        return redirect()->back();
    }

    public function clear()
    {
        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $shoppingCart = $this->getShoppingCart($customerId);

            $shoppingCart->deleted_on = Carbon::now();
            $shoppingCart->save();
        } else {
            session()->forget('cart');
        }

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

        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            $shoppingCart = $this->getShoppingCart($customerId);

            $productToCart = ProductToShoppingCart::query()
                ->where('shopping_cart_id', $shoppingCart->shopping_cart_id)
                ->where('product_id', $productId)
                ->first();

            if ($productToCart) {
                $productToCart->total_amount = $quantity;
                $productToCart->save();
            }

            $cart = $this->getShoppingCartItems($customerId);
        } else {
            $cart = session('cart', collect());

            if (isset($cart[$productId])) {
                $cart[$productId]->quantity = $quantity;
            }

            session(['cart' => $cart]);
        }

        $newSubtotal = 0;

        foreach ($cart as $prodId => $item) {
            $product = Product::find($prodId);
            if ($product) {
                $newSubtotal += $product->retail_price * $item->quantity;
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

        if (Auth::check()) {
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
        } else {
            $cart = session('cart', collect());
            if (isset($cart[$productId])) {
                $price = $cart[$productId]->product->retail_price * $quantity;
                return response()->json([
                    'price' => $price
                ]);
            } else {
                return response()->json([
                    'error' => 'Produkt nicht gefunden'
                ]);
            }
        }
    }

    public function getTotalCartPrice()
    {
        if (Auth::check()) {
            $cart = $this->getShoppingCartItems(Auth::user()->customer_id);
            $total = 0;
            foreach ($cart as $item) {
                $total += $item->product->retail_price * $item->quantity;
            }
            return response()->json([
                'subtotal' => $total,
                'total' => $total
            ]);
        } else {
            $cart = session('cart', collect());
            $total = 0;
            foreach ($cart as $prodId => $item) {
                $product = \App\Models\Product::find($prodId);
                if ($product) {
                    $total += $product->retail_price * $item->quantity;
                }
            }
            return response()->json([
                'subtotal' => $total,
                'total' => $total
            ]);
        }
    }


    private function getShoppingCart(int $customerId)
    {
        return ShoppingCart::query()
            ->select(ShoppingCart::TABLE . '.*')
            ->leftJoin(
                \App\Models\ShoppingOrder::TABLE,
                \App\Models\ShoppingOrder::TABLE . '.' . \App\Models\ShoppingOrder::SHOPPING_CART_ID,
                '=',
                \App\Models\ShoppingCart::TABLE . '.' . \App\Models\ShoppingCart::SHOPPING_CART_ID
            )
            ->where(ShoppingCart::CUSTOMER_ID, '=', $customerId)
            ->whereNull(ShoppingCart::DELETED_ON)
            ->whereNull(\App\Models\ShoppingOrder::ORDER_ID)
            ->firstOrNew();
    }

    private function getShoppingCartItems(int $customerId)
    {
        return ProductToShoppingCart::query()
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
            ->leftJoin(
                \App\Models\ShoppingOrder::TABLE,
                \App\Models\ShoppingOrder::TABLE . '.' . \App\Models\ShoppingOrder::SHOPPING_CART_ID,
                '=',
                \App\Models\ShoppingCart::TABLE . '.' . \App\Models\ShoppingCart::SHOPPING_CART_ID
            )
            ->where(
                ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID,
                '=',
                $customerId
            )
            ->whereNull(ShoppingCart::TABLE . '.' . ShoppingCart::DELETED_ON)
            ->whereNull(\App\Models\ShoppingOrder::ORDER_ID)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'product' => Product::find($item->product_id),
                    'quantity' => $item->total_amount
                ];
            });
    }

    private function createShoppingCart(int $customerId) {
        $maxCartId = DB::table('SHOPPING_CART')->max('SHOPPING_CART_ID');
        DB::statement("
            INSERT INTO SHOPPING_CART (SHOPPING_CART_ID, DELETED_ON, CREATED_ON, AMOUNT_OF_PRODUCTS, CUSTOMER_ID)
            VALUES (:shopping_cart_id, :deleted_on, :created_on, :amount_of_products, :customer_id)
            ", [
            'shopping_cart_id' => $maxCartId + 1,
            'deleted_on' => null,
            'created_on' => Carbon::now(),
            'amount_of_products' => 0,
            'customer_id' => $customerId
        ]);

        return $this->getShoppingCart($customerId);
    }

    private function updateAmountOfProducts($shoppingCart) {
        ShoppingCart::query()
            ->where(ShoppingCart::SHOPPING_CART_ID, '=', $shoppingCart->shopping_cart_id)
            ->update([ShoppingCart::AMOUNT_OF_PRODUCTS => $shoppingCart->amount_of_products + 1]);
    }
}
