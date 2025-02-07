<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\ShoppingCart;
use App\Models\ShoppingOrder;
use App\Models\ProductToShoppingCart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;#
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    public function loginPost(Request $request)
    {
        // Validierung der Eingabedaten
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        // Versuchen, den Kunden anhand der E-Mail zu finden
        $customer = Customer::where('email', $validated['email'])->first();
        if (!$customer) {
            return back()->withErrors(['email' => 'Diese E-Mail-Adresse wurde nicht gefunden.']);
        }
        
        // Finde das Benutzerkonto mit der customer_id des gefundenen Kunden
        $user = User::where('customer_id', $customer->customer_id)->first();
        //dd($user, $customer);
        if (!$user) {
            return back()->withErrors(['email' => 'Kein Benutzerkonto für diese E-Mail-Adresse gefunden.']);
        }
        
        //dd(Hash::check($validated['password'], $user->password));
        // Prüfe, ob das eingegebene Passwort mit dem gespeicherten Hash übereinstimmt
        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['password' => 'Das Passwort ist falsch.']);
        }
        $shopping_carts = ShoppingCart::where('customer_id', $customer->customer_id)->get();
        //dd($shopping_carts);
        $ordersData = [];

        foreach ($shopping_carts as $shopping_cart) {
            // Lade alle zugehörigen ShoppingOrders für dieses ShoppingCart
            $shopping_orders = ShoppingOrder::where('shopping_cart_id', $shopping_cart->shopping_cart_id)->get();

            foreach ($shopping_orders as $order) {
                // Lade alle ProductToShoppingCart-Daten für das aktuelle ShoppingCart
                $product_to_shopping_cart = ProductToShoppingCart::where('shopping_cart_id', $shopping_cart->shopping_cart_id)->get();

                // Hole alle Produkte, die in ProductToShoppingCart verwendet werden, in einer einzigen Abfrage
                $product_ids = $product_to_shopping_cart->pluck('product_id')->toArray();
                $products = Product::whereIn('product_id', $product_ids)->get()->keyBy('product_id');

                $product_data = [];
                foreach ($product_to_shopping_cart as $product_item) {
                    // Hole die Produktinformationen direkt aus der geladenen Kollektion
                    $product = $products->get($product_item->product_id);

                    if ($product) {
                        $product_data[] = [
                            'product_id' => $product->product_id,
                            'category_id' => $product->category_id,
                            'product_name' => $product->product_name,
                            'total_amount' => $product_item->total_amount,
                        ];
                    }
                }

                // Füge alle Daten für eine Bestellung in das Array ein
                $ordersData[] = [
                    'order_id' => $order->order_id,
                    'status' => $order->status,
                    'order_time' => $order->order_time,
                    'total_price' => $order->total_price,
                    'products' => $product_data, // Alle Produkte zu dieser Bestellung
                ];
            }
        }
        //dd($ordersData);

        // Authentifiziere den Benutzer
        Auth::loginUsingId($user->user_account_id, true);

        session()->flash('status', 'Erfolgreich eingeloggt!');
        session()->put('user', $user);
        session()->put('customer', $customer);
        session()->put('ordersData', $ordersData);

        // Funktionsweise überprüfen
        //dd($ordersData);

        // Weiterleitung nach erfolgreichem Login
        return redirect()->route('home')->with([
            'status' => 'Erfolgreich eingeloggt!'
        ]);
    }

    public function store(Request $request)
    {
        
        // Validierung des Formulars
        $validated = $request->validate([
            'forename' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            //'email' => 'required|email|unique:customer,email',
            'email' => 'required|email',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:34',
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:8',
        ]);
        
        $createdOn = Carbon::now()->format('d-m-y');
        
                // Erstellen des Kunden
        $customer = new Customer();
        //$customer->customer_id = DB::table('customer')->max('customer_id') + 1;
        $customer->customer_id = DB::table('customer')->max('customer_id') + 1;
        $customer->forename = $validated['forename'];
        $customer->middle_name = $validated['middle_name'] ?? null;
        $customer->lastname = $validated['lastname'];
        $customer->email = $validated['email'];
        $customer->street = $validated['street'] ?? null;
        $customer->house_number = $validated['house_number'] ?? null;
        $customer->postal_code = $validated['postal_code'];
        $customer->city = $validated['city'] ?? null;
        $customer->country = $validated['country'] ?? null;
        $customer->iban = $validated['iban'] ?? null;
        $customer->birth_date = $validated['birth_date'];  // Umgewandeltes Format

        //dd($customer['customer_id']);
        // Speichern des Kunden in der Datenbank
        $customer->save();

        // Erstellen des User_Account
        $datenow = Carbon::now()->toDateString();
        $timestamp = Carbon::now()->toDateTimeString();
        //dd($timestamp);
        $user_account = new User();
        $user_account->USER_ACCOUNT_ID = DB::table('users')->max('USER_ACCOUNT_ID') + 1;
        $user_account->CUSTOMER_ID = $customer['customer_id']   ;
        $user_account->PASSWORD = Hash::make($validated['password']);
        $user_account->PASSWORD_VALID_BEGIN = $timestamp;
        $user_account->PASSWORD_VALID_END = null;
        
       //dd($user_account);

       $user_account->save();
        return redirect()->route('login')->with('status', 'Registrierung erfolgreich!');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('home')->with('status', 'Erfolgreich ausgeloggt!');
    }
}
