<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class vectorController extends Controller
{
    public function index()
    {        
        return view('front.vectores');
    }
}