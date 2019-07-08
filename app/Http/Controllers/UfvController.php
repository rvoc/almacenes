<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ufv;

class UfvController extends Controller
{
    public function index()
    {
    	$ufvs = Ufv::get();
        return view('ufv.index', compact('ufvs'));
    }
}
