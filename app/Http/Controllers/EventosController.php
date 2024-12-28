<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;

class EventosController extends Controller
{
    //

    public function index()
    {
        // Obtener todos los eventos y devolverlos como JSON
        $eventos = Eventos::all();
        return response()->json($eventos);
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre_evento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'estado' => 'required|string',
        ]);

        // Creación del evento
        $evento = new Eventos();
        $evento->nombre_evento = $request->nombre_evento;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->estado = $request->estado;
        $evento->save();

        // Responder con el evento creado en formato JSON
        return response()->json($evento, 201);  // 201 para indicar que el recurso ha sido creado
    }

    public function edit($id)
    {
        // Obtener el evento a editar
        $evento = Eventos::findOrFail($id);
        return response()->json($evento);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre_evento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'estado' => 'required|string',
        ]);

        // Actualización del evento
        $evento = Eventos::findOrFail($id);
        $evento->nombre_evento = $request->nombre_evento;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->estado = $request->estado;
        $evento->save();

        // Responder con el evento actualizado en formato JSON
        return response()->json($evento);
    }

    public function destroy($id)
    {
        $evento = Eventos::findOrFail($id);
        $evento->delete();
        return response()->json(null, 204);  // 204 para indicar que el recurso ha sido eliminado
    }

    public function asistencias($id)
    {
        // Obtener el evento y sus asistencias
        $evento = Eventos::findOrFail($id);
        $asistencias = $evento->asistencias;
        return response()->json($asistencias);
    }
}
