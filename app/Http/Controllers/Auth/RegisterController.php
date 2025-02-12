<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $customer = new Customer();
        //$customer->customer_id = DB::table('customer')->max('customer_id') + 1;
        $customer->customer_id = DB::table('customer')->max('customer_id') + 1;
        $customer->forename = $data['forename'];
        $customer->middle_name = $data['middle_name'] ?? null;
        $customer->lastname = $data['lastname'];
        $customer->email = $data['email'];
        $customer->street = $data['street'] ?? null;
        $customer->house_number = $data['house_number'] ?? null;
        $customer->postal_code = $data['postal_code'];
        $customer->city = $data['city'] ?? null;
        $customer->country = $data['country'] ?? null;
        $customer->iban = $data['iban'] ?? null;
        $customer->birth_date = $data['birth_date'];
        $customer->save();

        $timestamp = Carbon::now()->toDateTimeString();

        return User::query()
            ->create([
                'user_account_id' => DB::table('USERS')->max('USER_ACCOUNT_ID') + 1,
                'customer_id' => $customer['customer_id'],
                'password' => Hash::make($data['password']),
                'password_valid_begin' => $timestamp,
                'password_valid_end' => null
            ]);
    }
}
