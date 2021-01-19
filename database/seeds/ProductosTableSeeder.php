<?php

use Illuminate\Database\Seeder;
use App\productos;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prod = new productos();
        $prod->referencia = 'prod1';
        $prod->descripcion = 'Producto 1';
        $prod->valor_unitario = 20;
        $prod->save();   
        
        $prod = new productos();
        $prod->referencia = 'prod2';
        $prod->descripcion = 'Producto 2';
        $prod->valor_unitario = 50;
        $prod->save();
        
        $prod = new productos();
        $prod->referencia = 'prod3';
        $prod->descripcion = 'Producto 3';
        $prod->valor_unitario = 1000;
        $prod->save();
        
        $prod = new productos();
        $prod->referencia = 'prod4';
        $prod->descripcion = 'Producto 4';
        $prod->valor_unitario = 2000;
        $prod->save();
        
        $prod = new productos();
        $prod->referencia = 'prod5';
        $prod->descripcion = 'Producto 5';
        $prod->valor_unitario = 10000;
        $prod->save();        
    }
}