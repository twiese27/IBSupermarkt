<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerExtension;
use App\Models\DeliveryService;
use App\Models\Employee;
use App\Models\Product;
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
        $customer = null;

        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;

            // Produkte und Preise in einer Abfrage holen
            $items = ProductToShoppingCart::query()
                ->select(
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::PRODUCT_ID,
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::TOTAL_AMOUNT,
                    Product::TABLE . '.' . Product::RETAIL_PRICE
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
                ->whereNull(\App\Models\ShoppingOrder::ORDER_ID)
                ->where(ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID, $customerId)
                ->whereNull(ShoppingCart::DELETED_ON)
                ->get();

            // Gesamtsumme berechnen
            $totalPrice = $items->sum(fn($item) => $item->retail_price * $item->total_amount);

            // Kundendaten abrufen
            $customer = Customer::find($customerId);
        } else {
            $cart = session('cart', collect());
            $productIds = array_keys($cart->toArray());

            // Alle Produkte auf einmal abrufen
            $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

            // Gesamtsumme berechnen
            foreach ($cart as $prodId => $item) {
                if (isset($products[$prodId])) {
                    $totalPrice += $products[$prodId]->retail_price * $item['quantity'];
                }
            }
        }

        return view('checkout', compact('totalPrice', 'customer'));
    }

    public function submit(Request $request)
    {
        if (Auth::check()) {
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
        } else {
            $maxCustomerId = DB::table('CUSTOMER')->max('CUSTOMER_ID');
            Customer::query()
                ->insert([
                    Customer::CUSTOMER_ID => $maxCustomerId + 1,
                    Customer::FORENAME => $request->input('forename'),
                    Customer::LASTNAME => $request->input('lastname'),
                    Customer::EMAIL => $request->input('email'),
                    //number
                    Customer::COUNTRY => $request->input('country_name'),
                    Customer::CITY => $request->input('city'),
                    Customer::STREET => $request->input('street'),
                    Customer::HOUSE_NUMBER => $request->input('house'),
                    Customer::POSTAL_CODE => $request->input('post'),
                ]);

            $maxCustomerExtensionId = DB::table('CUSTOMER_EXTENSION')->max('CUSTOMER_EXTENSION_ID');
            CustomerExtension::query()
                ->insert([
                    'CUSTOMER_EXTENSION_ID' => $maxCustomerExtensionId + 1,
                    'CUSTOMER_ID' => $maxCustomerId + 1,
                    'GENDER' => null,
                    'ADDITIONAL_DELIVERY_ADDRESS_INFORMATION' => null,
                    'IS_GUEST' => true,
                ]);

            $cart = session('cart', collect());
            $amountOfProducts = $cart->count();

            $maxShoppingCartId = DB::table('SHOPPING_CART')->max('SHOPPING_CART_ID');
            $shoppingCart = ShoppingCart::create([
                'shopping_cart_id' => $maxShoppingCartId + 1,
                'customer_id' => $maxCustomerId + 1,
                'amount_of_products' => $amountOfProducts,
                'created_on' => Carbon::now()
            ]);

            foreach ($cart as $prodId => $item) {
                ProductToShoppingCart::query()
                    ->insert([
                        ProductToShoppingCart::PRODUCT_ID => $item->product->product_id,
                        ProductToShoppingCart::SHOPPING_CART_ID => $shoppingCart->shopping_cart_id,
                        ProductToShoppingCart::TOTAL_AMOUNT => $item->quantity
                    ]);
            }

            $totalPrice = 0;
            $items = ProductToShoppingCart::query()
                ->select(ProductToShoppingCart::PRODUCT_ID, ProductToShoppingCart::TOTAL_AMOUNT)
                ->join(
                    ShoppingCart::TABLE,
                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                    '=',
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
                )
                ->where(ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID, $shoppingCart->shopping_cart_id)
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
        }

        session()->flash('success', 'Order successfully placed!');

        session()->forget('cart');

        return redirect()->route('home');
    }
}
