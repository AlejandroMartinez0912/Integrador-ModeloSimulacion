<?php

namespace App\Http\Controllers;

use App\Models\Semilla;
use App\Models\Numero;
use App\Services\NormalDistributionService; // ¡IMPORTANTE: Asegúrate de importar el servicio!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Para usar las sesiones flash
use App\Enums\TestSemilla; // Asegúrate de que este enum esté definido correctamente
class DistribucionNormalController extends Controller
{

    public function index($id, NormalDistributionService $normalDistService) // <-- ¡Inyección del servicio aquí!
    {
        $semilla = Semilla::findOrFail($id);
        $numerosCollection = Numero::where('semilla_id', $id)->get();
        $resultadosUniforms = $numerosCollection->pluck('resultados')->toArray();

        if ($semilla->test !== TestSemilla::Aprobado) {
            Session::flash('error', 'La semilla seleccionada no ha pasado el test de Chi-Cuadrado y no puede usarse para generar demandas normales.');
            return redirect()->route('semillas.index');
        }

        // Parámetros de la distribución normal deseada para la demanda (según el enunciado del problema)
        $modulus = $semilla->m; // El módulo M de la semilla es necesario para escalar los uniformes a [0, 1)
        $mean = 150;            // Media de la demanda
        $stdDev = 25;           // Desviación estándar de la demanda

        // Realizamos la transformación de los números uniformes a números con distribución normal
        $numerosNormales = $normalDistService->transformToNormal(
            $resultadosUniforms,
            $modulus,
            $mean,
            $stdDev
        );

        // Opcional: Armar marcas de clases para un análisis o visualización de la distribución de la demanda
        $marcasDeClasesDemanda = $normalDistService->armarMarcasDeClases($numerosNormales, 10); // Puedes ajustar el número de clases

        // Retornamos la vista con todos los datos relevantes para su visualización
        return view('distribucion.index', compact( // Asegúrate de que tu vista realmente se llama 'distribucion/index.blade.php'
            'semilla',
            'numerosNormales',
            'marcasDeClasesDemanda',
            'mean',
            'stdDev'
        ));
    }
}
