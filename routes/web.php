<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

Route::get('/welcome', function () {
    return view('welcome');
});

// Startseite
Route::get('/', [HomePageController::class, 'index']);

// Warenkorb
Route::get('/cart', [CartController::class, 'index']);

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index']);

// Login und Registrierung
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);

// Shop
Route::get('/shop-grid', [ShopController::class, 'grid']);
Route::get('/shop-single', [ShopController::class, 'single']);

// Test-Routen (Datenbankabfrage)
Route::get('/test', function () {
    $results = DB::select('SELECT * FROM CUSTOMER');
    return $results;
});

