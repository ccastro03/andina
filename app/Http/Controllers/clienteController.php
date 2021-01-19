<?php

namespace App\Http\Controllers;

use App\clientes;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class clienteController extends Controller
{

    use AuthenticatesUsers;

    public function loginView()
    {
        return 'auth.loginCarrito';
    } 
    
    public function showRegistroForm()
    {
        return view('auth.registro');
    }    

    public function username()
    {
        return 'codigo';
    }     

    public function guardia()
    {
        return 'cliente';
    }    

    public function redireccion()
    {
        return '/carrito';
    } 

    public function authenticated()
    {
        return redirect('/carrito');
    }    

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/carrito');
    }

    public function registro(Request $request)
    {
        $user = new clientes();
        $user->codigo = $request['usuario'];
        $user->nombre = $request['nombre'];
        $user->email = $request['mail'];
        $user->password = bcrypt($request['password']);
        $user->telefono = $request['tele'];
        $user->save();  

        return 'Cliente Registrado Correctamente';
    }    

}
