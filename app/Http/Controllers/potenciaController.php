<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class potenciaController extends Controller
{
    public function index()
    {        
        return view('front.potencia');
    }
}