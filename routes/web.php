<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumeroController;
use App\Http\Controllers\SemillaController;
use App\Http\Controllers\DistribucionNormalController;
use App\Http\Controllers\SimularController;

Route::get('/', function () {
    return view('home');
});

Route::get('/simulacion', function () {
    return view('simulacion');
})->name('simulacion');

Route::prefix('simulacion')->group(function () {
    Route::get('/numeros-aleatorios', [NumeroController::class, 'index'])->name('numeros.index');
    Route::post('/numeros-aleatorios', [NumeroController::class, 'generar'])->name('numeros.generar');

    Route::get('/semillas', [NumeroController::class, 'listarSemillas'])->name('semillas.index');
    Route::get('/semillas/{id}', [NumeroController::class, 'verDetalles'])->name('semillas.detalles');
    Route::get('/semillas/{id}/test', [SemillaController::class, 'probarChiCuadrado'])->name('semillas.probar');

    Route::get('/distribucion-normal/{id}', [DistribucionNormalController::class, 'index'])->name('distribucion.index');

});

// Ruta para simular el proyecto una vez cargados los numeros
Route::get('/simular', [SimularController::class, 'index'])->name('simular.index');

Route::post('/simular', [SimularController::class, 'simular'])->name('simular.simular');
