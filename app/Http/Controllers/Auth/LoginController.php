<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CustomerRecommendation;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function credentials(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return ['user_account_id' => null, 'password' => $request->password];
        }

        return [
            'customer_id' => $customer->customer_id, // Login erfolgt über die verknüpfte customer_id
            'password' => $request->password
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Hole die Customer-ID basierend auf der E-Mail-Adresse
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Diese E-Mail existiert nicht.']);
        }

        // Versuche den Login mit der Customer-ID
        if (Auth::attempt(['customer_id' => $customer->customer_id, 'password' => $request->password])) {
            $customerRecommendations = $this->getCustomerRecommendations($customer->customer_id);
            $productIds = collect($customerRecommendations)->pluck('suggested_product_id');
            $recommendedProducts = Product::whereIn('product_id', $productIds)->get();
            session()->put('recommendedProducts', $recommendedProducts);
        
            return redirect()->intended('/');
        }
        

        return back()->withErrors(['password' => 'Falsches Passwort']);
    }
    public function getCustomerRecommendations($customer_id)
    {
        $customerRecommendations = collect();
        $customerRecommendations = CustomerRecommendation::where('customer_id', $customer_id)->get();
        return $customerRecommendations;
    }

}
