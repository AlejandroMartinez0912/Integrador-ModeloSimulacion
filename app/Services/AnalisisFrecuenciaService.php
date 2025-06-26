<?php
namespace App\Services;

class AnalisisFrecuenciaService
{
    public function obtenerFrecuencias(array $resultados, $media, $desv)
    {
        // 1. Agrupar por intervalos de demanda (cada 10 unidades)
        $observadas = [];
        foreach ($resultados as $fila) {
            $valor = $fila['demanda'];
            $rango = floor($valor / 10) * 10;
            $observadas[$rango] = ($observadas[$rango] ?? 0) + 1;
        }
        ksort($observadas);

        // 2. Calcular frecuencias esperadas usando normal
        $total = count($resultados);
        $esperadas = [];

        foreach ($observadas as $rango => $obs) {
            $x1 = $rango;
            $x2 = $rango + 10;

            $probabilidad = $this->normalAcumulada($x2, $media, $desv) - $this->normalAcumulada($x1, $media, $desv);
            $esperadas[$rango] = round($probabilidad * $total);
        }

        return [
            'observadas' => $observadas,
            'esperadas' => $esperadas,
        ];
    }

    private function normalAcumulada($x, $media, $desv)
    {
        return 0.5 * (1 + $this->erf(($x - $media) / ($desv * sqrt(2))));
    }

    // Implementación de la función error (erf)
    private function erf($x)
    {
        // Constantes para la aproximación de Abramowitz y Stegun
        $a1 =  0.254829592;
        $a2 = -0.284496736;
        $a3 =  1.421413741;
        $a4 = -1.453152027;
        $a5 =  1.061405429;
        $p  =  0.3275911;

        // Guardar el signo de x
        $sign = ($x < 0) ? -1 : 1;
        $x = abs($x);

        // Fórmula de aproximación
        $t = 1.0 / (1.0 + $p * $x);
        $y = 1.0 - (((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t) * exp(-$x * $x);

        return $sign * $y;
    }
}
