<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class carritoController extends Controller
{
    public function index()
    {        
        $productos = DB::table('productos')->get();

        return view('front.carrito', [
            'productos' => $productos,
        ]);        
    }
}