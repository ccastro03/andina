<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class carritoController extends Controller
{
    public function index()
    {        
        return view('front.carrito');
    }
}