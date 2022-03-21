<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\EstadisticasController;


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
Route::post('registro', [RegistroController::class, 'registro']);
Route::post('login', [RegistroController::class, 'login'])->name('login');
     
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('contactos', ContactoController::class);
    Route::resource('estadisticas', EstadisticasController::class, ['only' => ['index']]);
});


