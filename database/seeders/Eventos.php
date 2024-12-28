<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Eventos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Eventos::create([
            'nombre_evento' => 'Evento 1',
            'descripcion' => 'Descripción del evento 1',
            'fecha_inicio' => '2021-01-01',
            'fecha_fin' => '2021-01-02',
            'estado' => 'Activo',
        ]);
        \App\Models\Eventos::create([
            'nombre_evento' => 'Evento 2',
            'descripcion' => 'Descripción del evento 2',
            'fecha_inicio' => '2021-02-01',
            'fecha_fin' => '2021-02-02',
            'estado' => 'Activo',
        ]);
        \App\Models\Eventos::create([
            'nombre_evento' => 'Evento 3',
            'descripcion' => 'Descripción del evento 3',
            'fecha_inicio' => '2021-03-01',
            'fecha_fin' => '2021-03-02',
            'estado' => 'Activo',
        ]);
    }
}
