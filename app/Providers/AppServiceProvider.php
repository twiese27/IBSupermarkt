<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        view()->composer('*', function ($view) {
            $recommendedProducts = [];
            if (auth()->check()) {
                $customerId = auth()->user()->customer_id;
                // Or retrieve from session if already set
                $recommendedProducts = session('recommendedProducts') ?? $this->getCustomerRecommendations($customerId);
            }
            $view->with('recommendedProducts', $recommendedProducts);
        });
    }
}
