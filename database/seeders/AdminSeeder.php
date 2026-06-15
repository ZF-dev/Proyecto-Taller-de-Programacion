<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'             => 'Master Admin',
            'email'            => 'admin@hotmail.com',
            'password'         => Hash::make('123456789ok'),
            'role'             => 'admin',
            'dni'              => 11111111,
            'fecha_nacimiento' => '1985-05-15',
        ]);

        User::create([
            'name'             => 'Joaco',
            'email'            => 'joaco@onlymotos.com',
            'password'         => Hash::make('joaco123'),
            'role'             => 'admin',
            'dni'              => 44123456,
            'fecha_nacimiento' => '2002-08-24',
        ]);

        User::create([
            'name'             => 'Fede',
            'email'            => 'fede@onlymotos.com',
            'password'         => Hash::make('fede123'),
            'role'             => 'admin',
            'dni'              => 44789012,
            'fecha_nacimiento' => '2003-03-12',
        ]);

        User::create([
            'name'             => 'Sofia Morales',
            'email'            => 'sofia.morales@onlymotos.com',
            'password'         => Hash::make('empleado1'),
            'role'             => 'admin',
            'dni'              => 38456123,
            'fecha_nacimiento' => '1994-11-05',
        ]);

        User::create([
            'name'             => 'Lucas Herrera',
            'email'            => 'lucas.herrera@onlymotos.com',
            'password'         => Hash::make('empleado2'),
            'role'             => 'admin',
            'dni'              => 41987654,
            'fecha_nacimiento' => '1999-07-19',
        ]);

        User::create([
            'name'             => 'Valentina Ruiz',
            'email'            => 'valentina.ruiz@onlymotos.com',
            'password'         => Hash::make('empleado3'),
            'role'             => 'admin',
            'dni'              => 43112233,
            'fecha_nacimiento' => '2001-01-30',
        ]);

        User::create([
            'name'             => 'pepe1',
            'email'            => 'pepe1@gmail.com',
            'password'         => Hash::make('pepe123'),
            'role'             => 'user',
            'dni'              => 35999888,
            'fecha_nacimiento' => '1991-04-20',
        ]);

        User::create([
            'name'             => 'pepe2',
            'email'            => 'pepe2@gmail.com',
            'password'         => Hash::make('pepe123'),
            'role'             => 'user',
            'dni'              => 36111222,
            'fecha_nacimiento' => '1992-09-14',
        ]);
    }
}
