<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\DocenteController;
use App\Http\Controllers\Api\MateriaController;
use App\Http\Controllers\Api\NotaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas 
Route::apiResource('home', HomeController::class);
Route::apiResource('estudiantes', EstudianteController::class);
Route::apiResource('docentes', DocenteController::class);
Route::apiResource('asignaturas', MateriaController::class);
Route::apiResource('notas', NotaController::class);
