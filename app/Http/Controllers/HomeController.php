<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->getStorage(); //importante no borrar obliga a que el usuario se le asigne un almacen de acuerdo a base
        // session()->put('storage_id', 1);
        return view('home');
    }
}
