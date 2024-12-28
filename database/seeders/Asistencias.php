<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Asistencias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Asistencia::create([
            'id_socio' => 5,
            'id_evento' => 1,
            'fecha_asistencia' => '2021-01-01',
        ]);
        \App\Models\Asistencia::create([
            'id_socio' => 5,
            'id_evento' => 2,
            'fecha_asistencia' => '2021-02-01',
        ]);
        \App\Models\Asistencia::create([
            'id_socio' => 5,
            'id_evento' => 3,
            'fecha_asistencia' => '2021-03-01',
        ]);
    }
}
