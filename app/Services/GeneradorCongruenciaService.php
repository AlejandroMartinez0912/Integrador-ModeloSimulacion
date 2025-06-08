<?php

namespace App\Services;

class GeneradorCongruenciaService
{
    public function generar($semilla, $a, $m, $cantidad)
    {
        $numeros = [];
        $x = $semilla;

        for ($i = 0; $i < $cantidad; $i++) {
            $x = ($a * $x) % $m;
            $r = round($x / $m, 4); // Número entre 0 y 1
            $numeros[] = $r;
        }

        return $numeros;
    }

    /**
     * Calcula el Máximo Común Divisor (MCD) entre dos números
     */
    public function mcd($a, $b)
    {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

}
