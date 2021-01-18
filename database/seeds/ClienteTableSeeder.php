<?php

use Illuminate\Database\Seeder;
use App\clientes;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new clientes();
        $user->codigo = 'prb';
        $user->nombre = 'Pruebas';
        $user->email = 'prb@gmail.com';
        $user->password = bcrypt('1234');
        $user->telefono = '123456789';
        $user->save();     
    }
}