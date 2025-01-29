<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\UserAccount;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return UserAccount::where('user_account_id', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        return null; // Falls Token-basiert benötigt, hier erweitern
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Falls Remember-Token genutzt wird, hier implementieren
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (!isset($credentials['email'])) {
            return null;
        }
    
        // Finde den Kunden anhand der E-Mail-Adresse
        $customer = Customer::where('email', $credentials['email'])->first();
        if (!$customer) {
            return null;
        }
    
        // Finde das zugehörige UserAccount für den Kunden
        return UserAccount::where('customer_id', $customer->customer_id)
            ->orderByDesc('password_valid_begin') // Um das neueste UserAccount zu holen
            ->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return Hash::check($credentials['password'], $user->password);
    }
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false): void
        {
            // Falls das Passwort neu gehasht werden muss, hier implementieren
        }
}
