<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Llamamos al UserSeeder correctamente
        $this->call([
            UserSeeder::class,  // Asegúrate de que esta línea esté aquí
        ]);
    }
}
