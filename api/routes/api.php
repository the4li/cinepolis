<?php

use App\Http\Controllers\Api\CarteleraController;
use App\Http\Controllers\Api\PeliculaController;
use App\Http\Controllers\Api\SalaController;
use Illuminate\Support\Facades\Route;

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
Route:: controller(PeliculaController::class)->group(function(){
    Route::get('/peliculas', 'index');
    Route::get('/pelicula/{id}', 'show');
    Route::post('/buscar', 'buscar');
});

Route:: controller(CarteleraController::class)->group(function(){
    Route::get('/cartelera', 'index');
    Route::get('/asientosSeleccionados/{idPelicula}/{horario}/{idioma}', 'asientosSeleccionados');
    Route::post('/seleccionarAsiento/{idPelicula}/{horario}/{idioma}', 'seleccionarAsiento');
});


