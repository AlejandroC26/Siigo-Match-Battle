<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name'=>'santiago',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador2',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador3',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador4',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador5',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador6',
            'password'=>bcrypt(123),
        ]);
        User::insert([
            'name'=>'jugador7',
            'password'=>bcrypt(123),
        ]);
    }
}
