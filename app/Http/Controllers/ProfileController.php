<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ProfileController
{

    public function index()
    {
        $user = Auth::user();

        $customer = Customer::query()
            ->where('CUSTOMER_ID', '=', $user->customer_id)
            ->firstOrNew();

        $ordersData = collect();

        $carts = ShoppingCart::query()
            ->select(
                'SHOPPING_ORDER.SHOPPING_CART_ID',
                'SHOPPING_ORDER.ORDER_ID',
                'SHOPPING_ORDER.ORDER_TIME',
                'SHOPPING_ORDER.TOTAL_PRICE',
                'SHOPPING_ORDER.STATUS'
            )
            ->join(
                'SHOPPING_ORDER',
                'SHOPPING_ORDER.SHOPPING_CART_ID',
                '=',
                'SHOPPING_CART.SHOPPING_CART_ID'
            )
            ->where('CUSTOMER_ID', '=', $customer->customer_id)
            ->get();

        foreach ($carts as $cart) {
            $order = [
                'order_id' => $cart->order_id,
                'order_time' => $cart->order_time,
                'total_price' => $cart->total_price,
                'status' => $cart->status,
                'products' => []
            ];

            $products = Product::query()
                ->select('PRODUCT.PRODUCT_ID', 'PRODUCT.PRODUCT_NAME', 'PRODUCT_TO_SHOPPING_CART.TOTAL_AMOUNT')
                ->join('PRODUCT_TO_SHOPPING_CART', 'PRODUCT.PRODUCT_ID', '=', 'PRODUCT_TO_SHOPPING_CART.PRODUCT_ID')
                ->where('PRODUCT_TO_SHOPPING_CART.SHOPPING_CART_ID', '=', $cart->shopping_cart_id)
                ->get();

            foreach ($products as $product) {
                $order['products'][] = [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'total_amount' => $product->total_amount
                ];
            }

            $ordersData->push($order);
        }

        return view('profile', ['user' => $user, 'customer' => $customer, 'ordersData' => $ordersData]);
    }

}
