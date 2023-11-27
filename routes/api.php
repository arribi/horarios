<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EspecialidadController;
use App\Http\Controllers\Api\V1\ModuloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('modulos', ModuloController::class)->missing(function () {
        return response()->json(['message' => 'El módulo no existe'], 404);
    });
    Route::get('especialidades/{especialidad}', [EspecialidadController::class, 'show'])->missing(function () {
        return response()->json(['message' => 'La especialidad no existe'], 404);
    });
    Route::get('especialidades/{especialidad}/modulos', [ModuloController::class, 'index'])->missing(function () {
        return response()->json(['message' => 'La especialidad no existe'], 404);
    });
});
