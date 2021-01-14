<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Response;

class usuariosController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

    public function index()
    {
        return view('admin.usuarios', ['pagTitulo' => "Usuarios"]);
    }

    public function show()
    {
        return Datatables(DB::table('usuarios')->get())->toJson();
    }

    public function store(Request $request)
    {	
		$User = new User();
        $User->usuario_id = $request['usucod'];
        $User->password = bcrypt($request['usupass']);        
        $User->usuario_nombre = $request['usunom'];
        $User->email = $request['usumail'];
        $User->usuario_telf = $request['usutel'];
        $User->save();           
        
        return 'Registro almacenado correctamente' ;
    }

    public function update(Request $request, $id)
    {
		$VerExist = DB::table('usuarios')->where('password', '=', $request['usupass'])->exists();
		if($VerExist == true){
            $contra = $request['usupass'];
		}else{
            $contra = bcrypt($request['usupass']);
        }

		$User = User::findOrFail($id);
        $User->password = $contra;
        $User->usuario_nombre = $request['usunom'];
        $User->email = $request['usumail'];
        $User->usuario_telf = $request['usutel'];
        $User->save();
        
        return 'Registro modificado correctamente' ;

        // return $Search['usuario_id'];
    }

    public function destroy(Request $request, $id)
    {
 
		$User = User::findOrFail($id);
		$User->delete();
        return 'Registro eliminado correctamente' ;
    }     
}