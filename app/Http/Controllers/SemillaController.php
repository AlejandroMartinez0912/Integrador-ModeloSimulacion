<?php

namespace App\Http\Controllers;

use App\Models\Semilla;
use App\Models\Numero;
use App\Services\TestChiCuadradoService;
use Illuminate\Http\Request;

class SemillaController extends Controller
{
    //

    public function probarChiCuadrado($id, TestChiCuadradoService $testService)
    {
        $semilla = Semilla::findOrFail($id);
        $numerosCollection = Numero::where('semilla_id', $id)->get();
        $resultados = $numerosCollection->pluck('resultados')->toArray();

        $resultado = $testService->probar($resultados);

        // Actualizamos la columna "test" con el resultado
        $estadoTexto = $resultado['pasa'] ? 'Paso test' : 'Falló test';
        Numero::where('semilla_id', $id)->update(['test' => $estadoTexto]);

        return view('semillas.test', [
            'semilla' => $semilla,
            'numeros' => $numerosCollection,
            'resultado' => $resultado,
        ]);
    }
}
