<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Providers\CustomUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registrieren von Auth- und Gate-Services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Benutzerdefinierten Auth-Provider registrieren
        Auth::provider('custom', function ($app, array $config) {
            return new CustomUserProvider();
        });
    }
}
