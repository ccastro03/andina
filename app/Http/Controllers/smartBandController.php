<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class smartBandController extends Controller
{
    public function index()
    {        
        return view('front.smartcard');
    }
}