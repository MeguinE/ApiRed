<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estatutos;

class EstatutosController extends Controller
{
    //

    public function index()
    {
        // Obtener todos los estatutos y devolverlos como JSON
        $estatutos = Estatutos::all();
        return response()->json($estatutos);
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'fecha_creacion' => 'required|date',
        ]);

        // Creación del estatuto
        $estatuto = new Estatutos();
        $estatuto->titulo = $request->titulo;
        $estatuto->contenido = $request->contenido;
        $estatuto->fecha_creacion = $request->fecha_creacion;
        $estatuto->save();

        // Responder con el estatuto creado en formato JSON
        return response()->json($estatuto, 201);  // 201 para indicar que el recurso ha sido creado
    }

    public function edit($id)
    {
        // Obtener el estatuto a editar
        $estatuto = Estatutos::findOrFail($id);
        return response()->json($estatuto);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'fecha_creacion' => 'required|date',
        ]);

        // Actualización del estatuto
        $estatuto = Estatutos::findOrFail($id);
        $estatuto->titulo = $request->titulo;
        $estatuto->contenido = $request->contenido;
        $estatuto->fecha_creacion = $request->fecha_creacion;
        $estatuto->save();

        // Responder con el estatuto actualizado en formato JSON
        return response()->json($estatuto);
    }

    public function destroy($id)
    {
        // Eliminar el estatuto
        $estatuto = Estatutos::findOrFail($id);
        $estatuto->delete();

        // Responder con un mensaje de éxito
        return response()->json(['message' => 'Estatuto eliminado']);
    }

    public function show($id)
    {
        // Obtener el estatuto por su ID
        $estatuto = Estatutos::findOrFail($id);
        return response()->json($estatuto);
    }

    public function search($titulo)
    {
        // Buscar estatutos por su título
        $estatutos = Estatutos::where('titulo', 'like', "%$titulo%")->get();
        return response()->json($estatutos);
    }

    public function searchByDate($fecha_creacion)
    {
        // Buscar estatutos por su fecha de creación
        $estatutos = Estatutos::where('fecha_creacion', $fecha_creacion)->get();
        return response()->json($estatutos);
    }

    public function searchByContent($contenido)
    {
        // Buscar estatutos por su contenido
        $estatutos = Estatutos::where('contenido', 'like', "%$contenido%")->get();
        return response()->json($estatutos);
    }

    public function searchByDateRange($fecha_inicio, $fecha_fin)
    {
        // Buscar estatutos por rango de fechas
        $estatutos = Estatutos::whereBetween('fecha_creacion', [$fecha_inicio, $fecha_fin])->get();
        return response()->json($estatutos);
    }

    public function searchByContentAndDate($contenido, $fecha_creacion)
    {
        // Buscar estatutos por contenido y fecha de creación
        $estatutos = Estatutos::where('contenido', 'like', "%$contenido%")
            ->where('fecha_creacion', $fecha_creacion)
            ->get();
        return response()->json($estatutos);
    }

    public function searchByContentAndDateRange($contenido, $fecha_inicio, $fecha_fin)
    {
        // Buscar estatutos por contenido y rango de fechas
        $estatutos = Estatutos::where('contenido', 'like', "%$contenido%")
            ->whereBetween('fecha_creacion', [$fecha_inicio, $fecha_fin])
            ->get();
        return response()->json($estatutos);
    }

    public function searchByDateAndContent($fecha_creacion, $contenido)
    {
        // Buscar estatutos por fecha de creación y contenido
        $estatutos = Estatutos::where('fecha_creacion', $fecha_creacion)
            ->where('contenido', 'like', "%$contenido%")
            ->get();
        return response()->json($estatutos);
    }
    
}
