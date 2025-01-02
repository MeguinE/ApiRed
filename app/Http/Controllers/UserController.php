<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {
        // Obtener todos los usuarios y devolverlos como JSON
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
{
    // Validación de los datos
    $request->validate([
        'nombre' => 'required|string',
        'apellidos' => 'required|string',
        'domicilio' => 'required|string',
        'correo_electronico' => 'required|email',
        'telefono' => 'required|string',
        'rfc' => 'required|string',
        'rnt' => 'required|string',
        'empresa' => 'required|string',
        'lugar_desarrollo' => 'required|string',
        'estado' => 'required|string',
        'usuario' => 'required|string',
        'contrasena' => 'required|string',
        'rol' => 'required|string',
        'fecha_registro' => 'required|date',
    ]);

    // Creación del usuario
    $user = new User();
    $user->nombre = $request->nombre;
    $user->apellidos = $request->apellidos;  // Cambio para coincidir con el nombre de la columna
    $user->domicilio = $request->domicilio;
    $user->correo_electronico = $request->correo_electronico;  // Cambio para coincidir con el nombre de la columna
    $user->telefono = $request->telefono;
    $user->rfc = $request->rfc;
    $user->rnt = $request->rnt;
    $user->empresa = $request->empresa;
    $user->lugar_desarrollo = $request->lugar_desarrollo;
    $user->estado = $request->estado;
    $user->usuario = $request->usuario;
    $user->contrasena = bcrypt($request->contrasena);  // Cifrado de la contraseña
    $user->rol = $request->rol;
    $user->fecha_registro = $request->fecha_registro;  // No es necesario modificar si la fecha es válida
    $user->save();

    // Responder con el usuario creado en formato JSON
    return response()->json($user, 201);  // 201 para indicar que el recurso ha sido creado
}


    public function edit($id)
    {
        // Obtener el usuario a editar
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'domicilio' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
            'rfc' => 'required|string',
            'rnt' => 'required|string',
            'empresa' => 'required|string',
            'lugar_desarrollo' => 'required|string',
            'estado' => 'required|string',
            'usuario' => 'required|string',
            'contrasena' => 'required|string',
            'rol' => 'required|string',
            'fecha_registro' => 'required|date',
        ]);

        // Actualización del usuario
        $user = User::findOrFail($id);
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellido;
        $user->domicilio = $request->domicilio;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->rfc = $request->rfc;
        $user->rnt = $request->rnt;
        $user->empresa = $request->empresa;
        $user->lugar_desarrollo = $request->lugar_desarrollo;
        $user->estado = $request->estado;
        $user->usuario = $request->usuario;
        $user->contrasena = $request->contrasena;
        $user->rol = $request->rol;
        $user->fecha_registro = $request->fecha_registro;
        $user->save();

        // Responder con el usuario actualizado en formato JSON
        return response()->json($user);
    }

    public function destroy($id)
    {
        // Eliminar el usuario
        $user = User::findOrFail($id);
        $user->delete();

        // Responder con código 204 (sin contenido)
        return response()->noContent();
    }

    public function show($id)
    {
        // Obtener el usuario y devolverlo como JSON
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function search(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'query' => 'required|string',
        ]);

        // Búsqueda de usuarios por nombre, apellido, empresa o lugar de desarrollo
        $query = $request->query('query');
        $users = User::where('nombre', 'like', "%$query%")
            ->orWhere('apellidos', 'like', "%$query%")
            ->orWhere('empresa', 'like', "%$query%")
            ->orWhere('lugar_desarrollo', 'like', "%$query%")
            ->get();

        // Responder con los usuarios encontrados en formato JSON
        return response()->json($users);
    }

    
}
