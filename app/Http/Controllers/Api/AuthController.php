<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        // Intentar autenticar con las credenciales
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {
            // Si las credenciales son correctas, obtener el usuario autenticado
            $user = Auth::user();

            // Crear el token de autenticación
            $token = $user->createToken('authToken', ['*'], now()->addMinutes(30))->plainTextToken;

            // Retornar solo la respuesta JSON con el token y un mensaje adicional
            return response()->json([
                "message" => "Login successful", // Mensaje adicional
                "token" => $token
            ], 200);
        } else {
            // Si las credenciales no son correctas, retornar un error de autenticación
            return response()->json(["message" => "Unauthorized"], 401);
        }
    }
}
