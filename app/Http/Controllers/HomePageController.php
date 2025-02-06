<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->limit(20)
            ->get();

        $user = Auth::user();
        $customer = $user ? $user->customer : null;

        return view('index', compact('products', 'user', 'customer'));
    }

}
