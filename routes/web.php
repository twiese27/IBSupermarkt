<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomePageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/controller', [HomePageController::class, 'index']);

Route::get('/test', function () {
    $results = DB::select('SELECT * FROM CUSTOMER');
    return $results;
});
