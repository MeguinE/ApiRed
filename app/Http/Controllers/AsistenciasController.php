<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciasController extends Controller
{
    //

    public function index()
    {
        // Obtener todas las asistencias y devolverlas como JSON
        $asistencias = Asistencia::all();
        return response()->json($asistencias);
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'id_evento' => 'required|exists:eventos,id_evento',
            'id_socio' => 'required|exists:users,id',
            'fecha_asistencia' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i:s',
            'hora_salida' => 'required|date_format:H:i:s',
        ]);

        // Creación de la asistencia
        $asistencia = new Asistencia();
        $asistencia->id_evento = $request->id_evento;
        $asistencia->id_socio = $request->id_socio;
        $asistencia->fecha_asistencia = $request->fecha_asistencia;
        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->hora_salida = $request->hora_salida;
        $asistencia->save();

        // Responder con la asistencia creada en formato JSON
        return response()->json($asistencia, 201);  // 201 para indicar que el recurso ha sido creado
    }

    public function edit($id)
    {
        // Obtener la asistencia a editar
        $asistencia = Asistencia::findOrFail($id);
        return response()->json($asistencia);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'id_evento' => 'required|exists:eventos,id_evento',
            'id_socio' => 'required|exists:users,id',
            'fecha_asistencia' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i:s',
            'hora_salida' => 'required|date_format:H:i:s',
        ]);

        // Actualización de la asistencia
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->id_evento = $request->id_evento;
        $asistencia->id_socio = $request->id_socio;
        $asistencia->fecha_asistencia = $request->fecha_asistencia;
        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->hora_salida = $request->hora_salida;
        $asistencia->save();

        // Responder con la asistencia actualizada en formato JSON
        return response()->json($asistencia);
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();
        return response()->json(null, 204);  // 204 para indicar que el recurso ha sido eliminado
    }

    public function asistenciasPorEvento($id_evento)
    {
        // Obtener todas las asistencias de un evento y devolverlas como JSON
        $asistencias = Asistencia::where('id_evento', $id_evento)->get();
        return response()->json($asistencias);
    }

    public function asistenciasPorSocio($id_socio)
    {
        // Obtener todas las asistencias de un socio y devolverlas como JSON
        $asistencias = Asistencia::where('id_socio', $id_socio)->get();
        return response()->json($asistencias);
    }

    public function asistenciasPorFecha($fecha)
    {
        // Obtener todas las asistencias de una fecha y devolverlas como JSON
        $asistencias = Asistencia::where('fecha_asistencia', $fecha)->get();
        return response()->json($asistencias);
    }

    public function asistenciasPorEventoYSocio($id_evento, $id_socio)
    {
        // Obtener todas las asistencias de un evento y socio y devolverlas como JSON
        $asistencias = Asistencia::where('id_evento', $id_evento)->where('id_socio', $id_socio)->get();
        return response()->json($asistencias);
    }

    
}
