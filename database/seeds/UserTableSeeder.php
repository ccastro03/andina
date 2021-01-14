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
        $user->usuario_id = 'Admin';
        $user->usuario_nombre = 'Administrador';
        $user->email = 'algo@algo.com';
        $user->password = bcrypt('secret');
        $user->usuario_telf = '8462748';
        $user->save();     
    }
}