<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        return view('homepage');
    }
}
