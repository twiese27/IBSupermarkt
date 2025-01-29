<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

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
       //dd($validated);

       $birthDate = $validated['birth_date'];
        // Datum konvertieren von 'dd-mm-yyyy' zu 'dd-mm-yy'
        /*if ($validated['birth_date']) {
            // Erstelle ein Carbon-Objekt und wandle das Datum um
            $birthDate = Carbon::createFromFormat('Y-m-d', $validated['birth_date']);
        }*/
        //dd($birthDate);
        $createdOn = Carbon::now()->format('d-m-y');
        
        //dd($createdOn);

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
        //dd($customer);

        // Speichern des Kunden in der Datenbank
        $customer->save();
/*
        // Erstellen des User_Account
        $user_account = UserAccount::create([
            //'USER_ACCOUNT_ID' => DB::table('user_account')->max('USER_ACCOUNT_ID') + 1,
            'USER_ACCOUNT_ID' => 1,
            'CUSTOMER_ID' => $customer->CUSTOMER_ID, 
            'PASSWORD' => $validated['password'],
            'PASSWORD_VALID_BEGINN' => Carbon::now(), // TODO: Wird das Attribut in der DB automatisch gepflegt? Eventuell knallt es hier, aufgrund unterschiedlichen Formats
            'PASSWORD_VALID_END' => null,
        ]);
*/
        return redirect()->route('login')->with('status', 'Registrierung erfolgreich!');
    }
}
