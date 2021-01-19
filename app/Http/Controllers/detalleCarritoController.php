<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class detalleCarritoController extends Controller
{
    public function index()
    {        
        $usuario = Auth::guard('cliente')->user()->id;

        $compras = DB::table('compras')->leftJoin('productos', 'productos.id', '=', 'compras.producto_id')
        ->select('compras.*', 'productos.*')->where('cliente_id','=',$usuario)->where('compra_estado','=','0')->get();

        $neto = DB::table('compras')->leftJoin('productos', 'productos.id', '=', 'compras.producto_id')
        ->select(DB::raw('SUM(compras.cantidad_producto * productos.valor_unitario) as neto'))->where('cliente_id','=',$usuario)
        ->where('compra_estado','=','0')->get();

        return view('front.detallecarrito', [
            'compras' => $compras,
            'neto' => $neto,
        ]);        
    }
}
