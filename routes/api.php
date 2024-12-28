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