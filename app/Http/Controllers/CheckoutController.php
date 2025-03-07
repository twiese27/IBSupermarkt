<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DeliveryService;
use App\Models\Employee;
use App\Models\ProductToShoppingCart;
use App\Models\ShoppingCart;
use App\Models\ShoppingOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $totalPrice = 0;

        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;

            $items = ProductToShoppingCart::query()
                ->select(ProductToShoppingCart::PRODUCT_ID, ProductToShoppingCart::TOTAL_AMOUNT)
                ->join(
                    ShoppingCart::TABLE,
                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                    '=',
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
                )
                ->where(ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID, $customerId)
                ->whereNull(ShoppingCart::DELETED_ON)
                ->get();

            foreach ($items as $item) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $totalPrice += $product->retail_price * $item->total_amount;
                }
            }

            $customer = Customer::query()
                ->where(Customer::CUSTOMER_ID, '=', Auth::user()->customer_id)
                ->firstOrNew();
        } else {
            $cart = session('cart', collect());

            foreach ($cart as $prodId => $item) {
                $product = \App\Models\Product::find($prodId);
                if ($product) {
                    $totalPrice += $product->retail_price * $item->quantity;
                }
            }

            $customer = null;
        }

        return view('checkout', compact('totalPrice', 'customer'));
    }

    public function submit()
    {
        $shoppingCart = ShoppingCart::query()
            ->where(ShoppingCart::CUSTOMER_ID, '=', Auth::user()->customer_id)
            ->firstOrNew();

        $totalPrice = 0;
        $items = ProductToShoppingCart::query()
            ->select(ProductToShoppingCart::PRODUCT_ID, ProductToShoppingCart::TOTAL_AMOUNT)
            ->join(
                ShoppingCart::TABLE,
                ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                '=',
                ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
            )
            ->where(ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID, Auth::user()->customer_id)
            ->whereNull(ShoppingCart::DELETED_ON)
            ->get();

        foreach ($items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $totalPrice += $product->retail_price * $item->total_amount;
            }
        }

        $deliveryService = DeliveryService::inRandomOrder()->first();
        $maxOrderId = DB::table('SHOPPING_ORDER')->max('ORDER_ID');


        DB::statement("
            INSERT INTO SHOPPING_ORDER (ORDER_ID, STATUS, ORDER_TIME, SHOPPING_CART_ID, EMPLOYEE_ID, DELIVERY_SERVICE_ID, TOTAL_PRICE)
            VALUES (:order_id, :status, :order_time, :shopping_cart_id, :employee_id, :delivery_service_id, :total_price)
        ", [
            'order_id' => $maxOrderId + 1,
            'status' => 'Shipped',
            'order_time' => Carbon::now(),
            'shopping_cart_id' => $shoppingCart->shopping_cart_id,
            'employee_id' => 1,
            'delivery_service_id' => $deliveryService->delivery_service_id,
            'total_price' => $totalPrice
        ]);

        session()->flash('success', 'Order successfully placed!');

        return redirect()->route('home');
    }
}
