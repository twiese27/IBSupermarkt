<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function grid()
    {
        return view('shop-grid');
    }

    public function single()
    {
        return view('shop-single');
    }
    
    public function searchResults()
    {
        return view('searchResults');
    }
}
