<?php

namespace App\Http\Controllers;

use App\productos;
use Response;
use DB;
use Datatables;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

    public function index()
    {
        return view('admin.productos');
    }

    public function show()
    {
        $prodctos = DB::table('productos')->get();

        return Datatables($prodctos)->toJson();
    }

    public function store(Request $request)
    {
		$prodctos = new productos();
        $prodctos->referencia = $request['referencia'];
        $prodctos->descripcion = $request['descripcion'];
        $prodctos->valor_unitario = $request['vlruni'];
        $prodctos->save();
        
        return 'Registro almacenado correctamente' ;
    }

    public function update(Request $request, $id)
    {
		$prodctos = productos::findOrFail($id);
        $prodctos->referencia = $request['referencia'];
        $prodctos->descripcion = $request['descripcion'];
        $prodctos->valor_unitario = $request['vlruni'];
        $prodctos->save();
        
        return 'Registro modificado correctamente' ;
    }

    public function destroy(Request $request, $id)
    {
		$prodctos = productos::findOrFail($id);
        $prodctos->delete();
        
        return 'Registro eliminado correctamente' ;
    }
}
