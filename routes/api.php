<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstatutosController;



Route::post('/login', [AuthController::class, 'login']);

    Route::apiResource('login', AuthController::class)->only(['store']);
    Route::apiResource('dashboard', ControllersDashboardController::class)->only(['index']);
    Route::apiResource('eventos', EventosController::class);
    Route::apiResource('asistencias', AsistenciasController::class);
    Route::apiResource('pagos', PagosController::class);
    Route::apiResource('users', UserController::class)->only(['index']);
    Route::apiResource('estatutos', EstatutosController::class);

    //Rutas personalizadas
    Route::get('asistencias/socio/{id}', [AsistenciasController::class, 'asistenciasPorSocio']);
    Route::get('asistencia/evento/{id}', [AsistenciasController::class, 'asistenciasPorEvento']);

    
    /*
    
    Configiración de esta parte de los tokens de autenticación
    1. Instalar Sanctum
    composer require laravel/sanctum
    2. Publicar la configuración de Sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    3. Ejecutar las migraciones
    php artisan migrate
    4. Agregar el middleware de autenticación a las rutas que lo requieran
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    5. Crear un token de autenticación
    $user = User::find(1);
    $token = $user->createToken('authToken')->plainTextToken;
    6. Enviar el token en las peticiones
    curl -X GET "http://localhost:800
    7. Revocar un token
    $user->tokens()->delete();
    8. Revocar todos los tokens
    $user->tokens->each->delete();
    9. Revocar un token específico
    $user->tokens->find($tokenId)->delete();
    10. Para la configuracion de las rutas se agrega el middleware de autenticación
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    11. Las demas rutas se pueden proteger con el middleware de autenticación
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
    
    */