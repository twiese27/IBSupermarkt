<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function sendResetLinkEmail(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Diese E-Mail existiert nicht.']);
        }

        // Hole die User-ID
        $user = User::where('customer_id', $customer->customer_id)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kein Benutzer gefunden.']);
        }

        // Standard-Passwort-Reset durchführen
        return Password::sendResetLink(['user_account_id' => $user->user_account_id]);
    }

}
