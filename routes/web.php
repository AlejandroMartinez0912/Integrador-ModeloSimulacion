<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumeroController;
use App\Http\Controllers\SemillaController;

Route::get('/', function () {
    return view('home');
});

Route::get('/simulacion', function () {
    return view('simulacion');
});

Route::prefix('simulacion')->group(function () {
    Route::get('/numeros-aleatorios', [NumeroController::class, 'index'])->name('numeros.index');
    Route::post('/numeros-aleatorios', [NumeroController::class, 'generar'])->name('numeros.generar');

    Route::get('/semillas', [NumeroController::class, 'listarSemillas'])->name('semillas.index');
    Route::get('/semillas/{id}', [NumeroController::class, 'verDetalles'])->name('semillas.detalles');
    Route::get('/semillas/{id}/test', [SemillaController::class, 'probarChiCuadrado'])->name('semillas.probar');

});
