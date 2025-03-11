<?php

namespace App\Http\Controllers;

use App\Models\ClusterCustomerRegressionData;
use App\Models\Customer;
use App\Models\CustomerExtension;
use App\Models\DeliveryService;
use App\Models\Discount;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\POSToCustomerExtension;
use App\Models\Product;
use App\Models\ProductToShoppingCart;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartToDiscount;
use App\Models\ShoppingOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected function validatorUser(Request $request) {
        return Validator::make($request->all(), [
            'forename' => 'required|string|max:20',
            'middlename' => 'nullable|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'street' => 'nullable|string|max:255',
            'house' => 'nullable|string|max:10',
            'post' => 'required|string|max:10',
            'city' => 'nullable|string|max:255',
            'country_name' => 'nullable|string|max:100',
            'iban' => 'nullable|string|max:34',
            'birth_date' => 'nullable|date',
            'payment_method' => 'required|in:Debit,Klarna,PayPal',
        ]);
    }

    protected function validatorGuest(Request $request) {
        return Validator::make($request->all(), [
            'forename' => 'required|string|max:20',
            'middlename' => 'nullable|string|max:100',
            'lastname' => 'required|string|max:100',
            //'email' => 'required|email|unique:customer,email',
            'email' => 'required|email|max:100',
            'street' => 'nullable|string|max:255',
            'house' => 'nullable|string|max:10',
            'post' => 'required|string|max:10',
            'city' => 'nullable|string|max:255',
            'country_name' => 'nullable|string|max:100',
            'iban' => 'nullable|string|max:34',
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:8',
            'payment_method' => 'required|in:Debit,Klarna,PayPal',
        ]);
    }

    public function index()
    {
        $totalPriceWithoutDiscount = 0;
        $totalPriceWithDiscount = 0;
        $customer = null;

        if (Auth::check()) {
            $discount = 0;
            $customerId = Auth::user()->customer_id;

            $clusterData = ClusterCustomerRegressionData::where('CUSTOMER_ID', $customerId)->first();
            $clusterCustomerId = $clusterData ? $clusterData->cluster_customer_id : 0;

            if ($clusterCustomerId == 1) {
                $discount = 7;
            } else if ($clusterCustomerId == 2) {
                $discount = 3;
            } else if ($clusterCustomerId == 3) {
                $discount = 10;
            } else if ($clusterCustomerId == 4) {
                $discount = 5;
            } else if ($clusterCustomerId == 5) {
                $discount = 1;
            }

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

            $totalPriceWithoutDiscount = round($items->sum(fn($item) => $item->retail_price * $item->total_amount), 2);

            $totalPriceWithDiscount = round($totalPriceWithoutDiscount * (1 - $discount / 100), 2);

            $customer = Customer::find($customerId);
        } else {
            $cart = session('cart', collect());

            foreach ($cart as $item) {
                $totalPriceWithoutDiscount += $item->product->retail_price * $item->quantity;
            }

            $totalPriceWithDiscount = $totalPriceWithoutDiscount;
        }

        return view('checkout', compact('totalPriceWithoutDiscount', 'totalPriceWithDiscount', 'customer'));
    }

    public function submit(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        if (Auth::check()) {
            $validator = $this->validatorUser($request);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $shoppingCart = ShoppingCart::query()
                ->where(ShoppingCart::CUSTOMER_ID, '=', Auth::user()->customer_id)
                ->firstOrNew();

            $totalPriceWithoutDiscount = 0;
            $totalPriceWithDiscount = 0;
            $discount = 0;

            $customerId = Auth::user()->customer_id;
            $clusterData = ClusterCustomerRegressionData::where('CUSTOMER_ID', $customerId)->first();
            $clusterCustomerId = $clusterData ? $clusterData->cluster_customer_id : 0;

            if ($clusterCustomerId == 1) {
                $discount = 7;
            } else if ($clusterCustomerId == 2) {
                $discount = 3;
            } else if ($clusterCustomerId == 3) {
                $discount = 10;
            } else if ($clusterCustomerId == 4) {
                $discount = 5;
            } else if ($clusterCustomerId == 5) {
                $discount = 1;
            }

            $items = ProductToShoppingCart::query()
                ->select(ProductToShoppingCart::PRODUCT_ID, ProductToShoppingCart::TOTAL_AMOUNT)
                ->join(
                    ShoppingCart::TABLE,
                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                    '=',
                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
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

            foreach ($items as $item) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $totalPriceWithoutDiscount += $product->retail_price * $item->total_amount;
                }
            }

            $totalPriceWithDiscount = $totalPriceWithoutDiscount * (1 - $discount / 100);

            $deliveryService = DeliveryService::inRandomOrder()->first();

            $shoppingOrder = new ShoppingOrder();
            $shoppingOrder->order_id = DB::table('SHOPPING_ORDER')->max('ORDER_ID') + 1;
            $shoppingOrder->status = 'Shipped';
            $shoppingOrder->order_time = Carbon::now();
            $shoppingOrder->shopping_cart_id = $shoppingCart->shopping_cart_id;
            $shoppingOrder->employee_id = 1;
            $shoppingOrder->delivery_service_id = $deliveryService->delivery_service_id;
            $shoppingOrder->total_price = $totalPriceWithDiscount;
            $shoppingOrder->save();

            $discountId = DB::table('Discount')->max('DISCOUNT_ID') + 1;

            Discount::query()
                ->insert([
                    Discount::DISCOUNT_ID => $discountId,
                    Discount::PERCENTAGE => $discount,
                    Discount::CODE => null
                ]);

            ShoppingCartToDiscount::query()
                ->insert([
                    ShoppingCartToDiscount::SHOPPING_CART_ID => $shoppingCart->shopping_cart_id,
                    ShoppingCartToDiscount::DISCOUNT_ID => $discountId
                ]);

            $paymentMethodId = PaymentMethod::query()
                ->where(
                    'NAME',
                    '=',
                    $paymentMethod
                )
                ->firstOrNew()
                ->payment_method_id;

            Payment::query()
                ->insert([
                    'PAYMENT_ID' => DB::table('PAYMENT')->max('PAYMENT_ID') + 1,
                    'PAYMENT_DATE' => Carbon::now(),
                    'CASH_FLOW' => $totalPriceWithDiscount,
                    'SUPPLIER_ID' => null,
                    'ORDER_ID' => $shoppingOrder->order_id,
                    'EMPLOYEE_ID' => null,
                    'WAREHOUSE_ID' => null,
                    'PAYMENT_METHOD_ID' => $paymentMethodId
                ]);
        } else {
            $validator = $this->validatorGuest($request);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $maxCustomerId = DB::table('CUSTOMER')->max('CUSTOMER_ID');
            Customer::query()
                ->insert([
                    Customer::CUSTOMER_ID => $maxCustomerId + 1,
                    Customer::FORENAME => $request->input('forename'),
                    Customer::LASTNAME => $request->input('lastname'),
                    Customer::EMAIL => $request->input('email'),
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
                    'IS_GUEST' => !$request->has('create_account'),
                ]);

            if (!$request->has('create_account')) {
                User::query()
                    ->create([
                        'user_account_id' => DB::table('USERS')->max('USER_ACCOUNT_ID') + 1,
                        'customer_id' => $maxCustomerId + 1,
                        'password' => Hash::make($request->input('password')),
                        'password_valid_begin' => Carbon::now()->toDateTimeString(),
                        'password_valid_end' => null
                    ]);
            } else {
                dd('problem');
            }


            $POSToCustomerExtension = new POSToCustomerExtension();
            //$POSToCustomerExtension->customer_extension_id = DB::table('pos_to_customer_extension')->max($customerExtension->customer_extension_id);
            $POSToCustomerExtension->customer_id = $maxCustomerId + 1;
            $POSToCustomerExtension->customer_extension_id = $maxCustomerExtensionId + 1;
            $POSToCustomerExtension->point_of_sale_id = 2;

            $POSToCustomerExtension->save();

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

            $totalPriceWithoutDiscount = 0;
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
                    $totalPriceWithoutDiscount += $product->retail_price * $item->total_amount;
                }
            }

            $totalPriceWithDiscount = $totalPriceWithoutDiscount;

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
                'total_price' => $totalPriceWithDiscount
            ]);
        }

        $paymentMethodId = PaymentMethod::query()
            ->where(
                'NAME',
                '=',
                $paymentMethod
            )
            ->firstOrNew()
            ->payment_method_id;

        Payment::query()
            ->insert([
                'PAYMENT_ID' => DB::table('PAYMENT')->max('PAYMENT_ID') + 1,
                'PAYMENT_DATE' => Carbon::now(),
                'CASH_FLOW' => $totalPriceWithDiscount,
                'SUPPLIER_ID' => null,
                'ORDER_ID' => $maxOrderId + 1,
                'EMPLOYEE_ID' => null,
                'WAREHOUSE_ID' => null,
                'PAYMENT_METHOD_ID' => $paymentMethodId
            ]);

        session()->flash('success', 'Order successfully placed!');
        session()->forget('cart');

        return redirect()->route('home');
    }
}
