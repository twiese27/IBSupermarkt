<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->limit(20)
            ->get();

        return view('index', ['products' => $products]);
    }
}
