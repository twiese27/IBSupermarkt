<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

//Suchbutton
Route::get('/search', [HomePageController::class, 'search'])->name('search');

// Warenkorb
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/{id}', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/total-price', [CartController::class, 'getTotalPrice'])->name('cart.total-price');
Route::post('/cart/total-cart-price', [CartController::class, 'getTotalCartPrice'])->name('cart.total-cart-price');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Login und Registrierung
//Route::get('/login', [AuthController::class, 'login'])->name('login');
//Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
//Route::get('/register', [AuthController::class, 'register'])->name('register');
//Route::post('/register', [AuthController::class, 'store'])->name('register.store');
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Shop
Route::get('/shop-grid', [ShopController::class, 'grid'])->name('shop-grid');
Route::get('/shop-single', [ShopController::class, 'single'])->name('shop-single');
Route::get('/search-results', [ShopController::class, 'searchResults'])->name('searchResults');

//Profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

//Produktkategorien
Route::get('category/{name}', [CategoryController::class, 'index'])->name('category');

//Produktdetailseite
Route::get('/product', [ProductController::class, 'index'])->name('product');

//AGB
Route::get('/agb', [\App\Http\Controllers\AGBController::class, 'index'])->name('agb');

//Über uns
Route::get('/aboutus', [\App\Http\Controllers\AboutUsController::class, 'index'])->name('aboutus');

//FAQ
Route::get('/faq',[\App\Http\Controllers\FAQController::class, 'index'])->name('faq');

// Test-Routen (Datenbankabfrage)
Route::get('/test', function () {
    //    $results = DB::select('SELECT * FROM CUSTOMER');
    $results = \App\Models\Warehouse::query()->get();
    return $results;
})->name('test');

Route::get('/search', [ProductController::class, 'search'])->name('search');
