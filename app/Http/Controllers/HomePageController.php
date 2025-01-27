<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->get();

        return view('index', ['users' => $users]);
    }
}
