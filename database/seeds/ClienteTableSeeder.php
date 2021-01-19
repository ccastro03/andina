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
        $user->codigo = 'carlos';
        $user->nombre = 'Carlos Castro';
        $user->email = 'carlos@gmail.com';
        $user->password = bcrypt('1234');
        $user->telefono = '123456789';
        $user->save();     
    }
}