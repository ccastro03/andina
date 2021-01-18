<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->codigo = 'Admin';
        $user->nombre = 'Administrador';
        $user->email = 'algo@algo.com';
        $user->password = bcrypt('1234');
        $user->telefono = '123456789';
        $user->save();     
    }
}