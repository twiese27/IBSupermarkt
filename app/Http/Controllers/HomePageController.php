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
        
        $user = Auth::user(); // Gibt den eingeloggten User zurück (oder null)
        $customer = $user ? $user->customer : null; // Falls ein User existiert, lade den zugehörigen Customer


        return view('index', compact('products', 'user', 'customer'));
    }
}
