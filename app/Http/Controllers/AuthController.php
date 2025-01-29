<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'))->with('success', 'Logout erfolgreich!');
    }
    public function loginPost(Request $request){
        // Validierung der Login-Daten
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Suche den Kunden anhand der E-Mail in der CUSTOMER-Tabelle
        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            // Finde das zugehörige UserAccount
            $userAccount = UserAccount::where('customer_id', $customer->customer_id)->first();

            // Wenn das UserAccount und das Passwort stimmen
            if ($userAccount && Hash::check($request->password, $userAccount['password'])) {
                
                //Auth::guard('web')->login($userAccount);
                Auth::guard('web')->loginUsingId($userAccount['USER_ACCOUNT_ID']);
                return redirect()->intended(route('home'))->with('success', 'Login erfolgreich!');
            }
        }

        return redirect(route('login'))->with('error', 'Login fehlgeschlagen!');
    }

    public function register()
    {
        return view('register');
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
        $user_account = new UserAccount();
        $user_account->USER_ACCOUNT_ID = DB::table('user_account')->max('USER_ACCOUNT_ID') + 1;
        $user_account->CUSTOMER_ID = $customer['customer_id']   ;
        $user_account->PASSWORD = Hash::make($validated['password']);
        $user_account->PASSWORD_VALID_BEGIN = $timestamp;
        $user_account->PASSWORD_VALID_END = null;
        
       //dd($user_account);

       $user_account->save();
        return redirect()->route('login')->with('status', 'Registrierung erfolgreich!');
    }
}
