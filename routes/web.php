<?php

Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });
Route::get('/clear-cache', function() {      $exitCode = Artisan::call('cache:clear');      return '<h1>Cache facade value cleared</h1>';  });

Route::get('/', 'inicioController@index');
Route::get('/Inicio', 'inicioController@index');
Route::get('/inicio', 'inicioController@index');

Route::get('/vectores', 'vectorController@index');
Route::get('/potencia', 'potenciaController@index');
Route::get('/smartcard', 'smartBandController@index');
Route::get('/carrito', 'carritoController@index');

Route::get('/detalleCarrito', 'detalleCarritoController@index');

Route::post('/agregarProducto', 'frontController@agregarProducto');
Route::post('/limpiarCarrito', 'frontController@limpiarCarrito');
Route::post('/terminarCompra', 'frontController@terminarCompra');
Route::post('/eliminarProducto', 'frontController@eliminarProducto');

Auth::routes();

Route::get('/ingresar', 'clienteController@showLoginForm');
Route::get('/registrar', 'clienteController@showRegistroForm');

Route::post('/cliente/login', 'clienteController@login');
Route::post('/cliente/registro', 'clienteController@registro');

Route::group(array('before' => 'auth'), function(){

    Route::get('/administrador', 'adminController@index');
    Route::get('/Administrador', 'adminController@index');

    /*  USUARIOS  */
        Route::resource('/usuarios', 'usuariosController')->middleware('auth');
    /************/ 

    /*  PRODCUTOS  */
        Route::resource('/productos', 'ProductosController')->middleware('auth');
    /************/     

});