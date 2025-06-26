@extends('layout.layout')

@section('title', 'Ayuda - Método de Congruencia Mixta')

@section('content')
<h1>🧮 Test de Chi-cuadrado</h1>
<p>
    El test de Chi-cuadrado (χ²) permite verificar si los números generados están uniformemente distribuidos. Se compara la frecuencia con que aparecen los números generados (observadas) con la frecuencia que se espera si fueran verdaderamente aleatorios (esperadas).
</p>
<h2>Pasos para aplicarlo:</h2>
<ol>
   
    <li>
        <strong>Generar una muestra de <i>n</i> números pseudoaleatorios</strong>.
    </li>
    <li>
        <strong>Contar cuántos valores caen en cada intervalo</strong> → <i>O<sub>i</sub></i> (frecuencia observada).
    </li>
    <li>
        <strong>Calcular la frecuencia esperada por intervalo</strong> → <i>E<sub>i</sub> = n/k</i>.
    </li>
    <li>
        <strong>Calcular el estadístico</strong>:
        <p>
            χ² = ∑<sub>i=1</sub><sup>k</sup>(O<sub>i</sub> - E<sub>i</sub>)² / E<sub>i</sub>
        </p>
    </li>
    <li>
        <strong>Comparar con el valor de tabla</strong> χ²<sub>α,k-1</sub> según el nivel de significancia deseado.
    </li>
</ol>
<h2>Interpretación:</h2>
<ul>
    <li>
        <strong>Si χ² calculado &lt; χ² tabla</strong>: no se rechaza la hipótesis nula → la distribución es uniforme.
    </li>
    <li>
        <strong>Si χ² calculado &gt; χ² tabla</strong>: se rechaza la hipótesis → los datos no son uniformes.
    </li>
</ul>
<div class="d-flex justify-content-left mt-4"> {{-- Agregamos mt-4 para espacio superior --}}
                <a href="{{ route('semillas.probar', ['id' => $id]) }}" class="btn me-3" {{-- me-3 para más espacio entre botones --}}
                    style="background-color: #a56607; color: #fff; border: none;">Volver</a>
                {{-- <button type="submit" class="btn btn-primary">Generar</button> --}}
            </div>
@endsection