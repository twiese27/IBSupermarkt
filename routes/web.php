<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomePageController;

Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/', [HomePageController::class, 'index']);

Route::get('/', function () {
    return view('index');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/shop-grid', function () {
    return view('shop-grid');
});

Route::get('/shop-single', function () {
    return view('shop-single');
});

Route::get('/controller', [HomePageController::class, 'index']);

Route::get('/test', function () {
    $results = DB::select('SELECT * FROM CUSTOMER');
    return $results;
});
