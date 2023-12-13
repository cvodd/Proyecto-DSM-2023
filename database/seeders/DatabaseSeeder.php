<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nombre',
            'lastName' => 'Apellido',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Puedes usar bcrypt('password') también
            'userName' => 'username',
            'status' => 'active',
            'birthDate' => '1990-01-01', // Cambia según la fecha que desees
            'role' => 1, // Cambia según los roles de tu aplicación
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Administrador',
            'lastName'=> '',
            'email' => 'administrador@admin.cl',
            'password' => bcrypt('administrador123'),
            'userName' => 'ADMIN',
            'birthDate' => '2000-01-01',
            'status' => 'active',
            'role' => 2
        ]);
    }
}
