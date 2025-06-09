<?php

namespace App\Services;

class TestChiCuadradoService
{
    public function probar(array $numeros, int $clases = 10): array
    {
        $n = count($numeros);
        $frecuenciasObservadas = array_fill(0, $clases, 0);

        // Asignamos los números a clases
        foreach ($numeros as $num) {
            $indice = min((int)floor($num * $clases), $clases - 1);
            $frecuenciasObservadas[$indice]++;
        }

        $frecuenciaEsperada = $n / $clases;
        $chiCuadrado = 0;

        foreach ($frecuenciasObservadas as $fo) {
            $chiCuadrado += pow($fo - $frecuenciaEsperada, 2) / $frecuenciaEsperada;
        }

        // Tabla de valores críticos para α = 0.05
        $tablaCriticos = [
            1 => 3.84, 2 => 5.99, 3 => 7.81, 4 => 9.49,
            5 => 11.07, 6 => 12.59, 7 => 14.07, 8 => 15.51,
            9 => 16.92, 10 => 18.31, 11 => 19.68, 12 => 21.03,
            13 => 22.36, 14 => 23.68, 15 => 25.00, 16 => 26.30,
        ];

        $gl = $clases - 1;
        $valorCritico = $tablaCriticos[$gl] ?? 18.31;

        return [
            'chiCuadrado' => round($chiCuadrado, 4),
            'valorCritico' => $valorCritico,
            'gl' => $gl,
            'pasa' => $chiCuadrado <= $valorCritico,
            'frecuenciasObservadas' => $frecuenciasObservadas,
            'frecuenciaEsperada' => round($frecuenciaEsperada, 4),
        ];
    }
}
