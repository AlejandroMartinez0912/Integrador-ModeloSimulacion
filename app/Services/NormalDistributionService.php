<?php

namespace App\Services;

class NormalDistributionService
{
    /**
     * Transforma un array de números uniformes (en el rango [0, M-1])
     * a un array de números que siguen una distribución normal.
     * Utiliza el método Box-Muller.
     *
     * @param array $uniformNumbers Números enteros generados por el LCG (Lineal Congruential Generator).
     * @param int $modulus El módulo M utilizado en el LCG para escalar los números a [0, 1).
     * @param float $mean La media (mu) de la distribución normal deseada.
     * @param float $stdDev La desviación estándar (sigma) de la distribución normal deseada.
     * @return array Array de números que siguen la distribución normal.
     */
    public function transformToNormal(array $uniformNumbers, int $modulus, float $mean, float $stdDev): array
    {
        $normalNumbers = [];
        $count = count($uniformNumbers);

        // Box-Muller requiere al menos dos números uniformes para producir dos números normales.
        // Si tenemos un número impar, el último número uniforme será ignorado en este proceso por pares.
        $epsilon = PHP_FLOAT_EPSILON; // Un valor muy pequeño para evitar log(0)

        for ($i = 0; $i < $count - 1; $i += 2) {
            // Escalar los números uniformes generados por el LCG (rango [0, M-1]) al rango [0, 1).
            // Usamos $modulus para el escalado.
            // Es importante que $u1 y $u2 estén en el rango (0, 1) exclusivo para evitar log(0).
            $u1 = ($uniformNumbers[$i] / $modulus);
            $u2 = ($uniformNumbers[$i+1] / $modulus);

            // Asegurar que U1 y U2 no sean 0 para evitar log(0)
            if ($u1 == 0) $u1 = $epsilon;
            if ($u2 == 0) $u2 = $epsilon;

            // Aplicar la Transformada de Box-Muller para obtener dos variables normales estándar (media 0, desviación 1)
            $z1 = sqrt(-2 * log($u1)) * cos(2 * M_PI * $u2);
            $z2 = sqrt(-2 * log($u1)) * sin(2 * M_PI * $u2);

            // Transformar las variables normales estándar a la distribución normal deseada (media y desviación dadas)
            $normalNumbers[] = $mean + ($z1 * $stdDev);
            $normalNumbers[] = $mean + ($z2 * $stdDev);
        }
        
        // Devolver la misma cantidad de números normales que se ingresaron,
        // o la cantidad máxima que Box-Muller pudo generar en pares.
        return array_slice($normalNumbers, 0, $count); 
    }

    /**
     * Método auxiliar para armar "marcas de clases" (bins) para un conjunto de datos.
     * Esto es útil para visualización (ej. histogramas) o análisis de la distribución.
     *
     * @param array $data Los números generados (ej. demandas normales).
     * @param int $numBins El número de clases (bins) a crear.
     * @return array Un array de arrays, donde cada subarray representa una clase con su rango y conteo.
     */
    public function armarMarcasDeClases(array $data, int $numBins = 10): array
    {
        if (empty($data)) {
            return [];
        }

        $min = min($data);
        $max = max($data);
        $range = $max - $min;

        if ($range == 0 || $numBins <= 0) { // Manejar casos donde el rango es 0 o numBins es inválido
            return [[
                'clase_inferior' => round($min, 2),
                'clase_superior' => round($max, 2),
                'frecuencia' => count($data),
                'marca_clase' => round($min, 2),
            ]];
        }

        $binWidth = $range / $numBins;
        $bins = [];

        for ($i = 0; $i < $numBins; $i++) {
            $lowerBound = $min + ($i * $binWidth);
            $upperBound = $min + (($i + 1) * $binWidth);
            $bins[] = [
                'clase_inferior' => round($lowerBound, 2),
                'clase_superior' => round($upperBound, 2),
                'frecuencia' => 0,
                'marca_clase' => round($lowerBound + ($binWidth / 2), 2),
            ];
        }

        foreach ($data as $value) {
            // Determinar a qué bin pertenece el valor
            $binIndex = floor(($value - $min) / $binWidth);
            
            // Asegurarse de que el valor máximo caiga en el último bin
            if ($binIndex == $numBins) {
                $binIndex--;
            }
            // Asegurarse de que el binIndex sea válido (entre 0 y $numBins - 1)
            $binIndex = max(0, min($numBins - 1, $binIndex));


            if (isset($bins[$binIndex])) {
                $bins[$binIndex]['frecuencia']++;
            }
        }

        return $bins;
    }
}
