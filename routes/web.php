<?php

use App\Http\Controllers\CategoryController;
use App\Http\Middleware\CategoryMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Startseite
//Route::middleware([CategoryMiddleware::class])->group(function () {
    Route::get('/', [HomePageController::class, 'index'])
        ->name('home');
//});

// Warenkorb
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Login und Registrierung
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

// Shop
Route::get('/shop-grid', [ShopController::class, 'grid'])->name('shop-grid');
Route::get('/shop-single', [ShopController::class, 'single'])->name('shop-single');

//Profil
Route::get('/profile',[ProfileController::class,'index'])->name('profile');

//Produktkategorien
Route::get('category/{name}', [CategoryController::class, 'index'])->name('category');

// Test-Routen (Datenbankabfrage)
Route::get('/test', function () {
//    $results = DB::select('SELECT * FROM CUSTOMER');
    $results = \App\Models\Warehouse::query()->get();
    return $results;
})->name('test');

