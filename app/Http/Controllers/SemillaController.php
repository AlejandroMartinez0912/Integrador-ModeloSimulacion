<?php

namespace App\Http\Controllers;

use App\Models\Semilla;
use App\Models\Numero;
use App\Services\TestChiCuadradoService;
use Illuminate\Http\Request;
use App\Enums\TestSemilla;
use PHPUnit\Event\Code\Test;

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
        $estadoTexto = $resultado['pasa'] ? TestSemilla::Aprobado : TestSemilla::Rechazado;
        $semilla->test = $estadoTexto;
        $semilla->save();
        return view('semillas.test', [
            'semilla' => $semilla,
            'numeros' => $numerosCollection,
            'resultado' => $resultado,
        ]);
    }
}
