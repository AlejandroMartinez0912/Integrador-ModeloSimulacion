<?php

namespace App\Services;

class TestChiCuadradoService
{
    public function probar(array $numeros, int $clases = 10): bool
    {
        $n = count($numeros);

        // Inicializamos las clases
        $frecuenciasObservadas = array_fill(0, $clases, 0);

        // Contar cuántos números caen en cada clase
        foreach ($numeros as $num) {
            $indice = min((int)floor($num * $clases), $clases - 1);
            $frecuenciasObservadas[$indice]++;
        }

        $frecuenciaEsperada = $n / $clases;
        $chiCuadrado = 0;

        foreach ($frecuenciasObservadas as $fo) {
            $chiCuadrado += pow($fo - $frecuenciaEsperada, 2) / $frecuenciaEsperada;
        }

        // Valor crítico (alfa = 0.05) para gl = clases - 1
        $tablaCriticos = [
            5 => 11.07, 6 => 12.59, 7 => 14.07, 8 => 15.51, 9 => 16.92, 10 => 18.31
        ];

        $gl = $clases - 1;
        $valorCritico = $tablaCriticos[$gl] ?? 16.92; // valor por defecto si no está

        return $chiCuadrado <= $valorCritico;
    }
}
