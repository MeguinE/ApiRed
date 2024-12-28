<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pére',
            'domicilio' => 'Calle Ficticia 123',
            'correo_electronico' => 'juanpez@example.com',
            'telefono' => '1234567890',
            'rfc' => 'JUPJ800101',
            'rnt'=>'12345678901234567890',
            'empresa' => 'Mi Empresa',
            'lugar_desarrollo' => 'Ciudad',
            'estado' => 'Activo',
            'usuario' => 'juanperez',
            'contrasena' => bcrypt('contraseña123'),
            'rol' => 'admin',
                    ]);

    }
}
