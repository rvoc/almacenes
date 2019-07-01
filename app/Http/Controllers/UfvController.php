<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UfvController extends Controller
{
    public function index()
    {
        return view('ufv.index');
    }
}
