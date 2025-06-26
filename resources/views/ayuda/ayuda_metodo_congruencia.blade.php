@extends('layout.layout')

@section('title', 'Ayuda - Método de Congruencia Mixta')

@section('content')
    <h1 class="text-center">🧮 Método de Congruencia Mixta</h1>
    <p>
        El método de congruencia mixta es una técnica determinística utilizada para generar números
        pseudoaleatorios mediante una fórmula matemática simple. Su principal ventaja es la facilidad
        de implementación, velocidad y buen comportamiento estadístico si se eligen bien los parámetros.
    </p>
    <p>
        La fórmula que define este método es:
    </p>
    <div class="text-center">
<p>V<sub>i+1</sub> = (a × V<sub>i</sub> + c) mod m</p>    </div>
    <p>
        Donde:
    </p>
    <ul>
        <li><code>V<sub>i</sub></code>: es el valor actual (o semilla en el primer paso).</li>
        <li><code>a</code>: es la constante multiplicativa.</li>
        <li><code>c</code>: es la constante aditiva.</li>
        <li><code>m</code>: es el módulo, que define el rango de los números generados.</li>
        <li><code>V<sub>i+1</sub></code>: es el siguiente número de la secuencia.</li>
    </ul>
    <p>
        <strong>Condiciones para buen funcionamiento:</strong>
    </p>
    <ul>
        <li><code>a</code> debe ser impar, y no divisible por 3 ni por 5.</li>
        <li><code>c</code> debe ser impar y primo relativo con <code>m</code> (es decir, no compartir factores).</li>
        <li><code>m</code> debe ser lo suficientemente grande para lograr un período largo.</li>
    </ul>
     <div class="d-flex justify-content-left mt-4"> {{-- Agregamos mt-4 para espacio superior --}}
                <a href="{{ route('numeros.index') }}" class="btn me-3" {{-- me-3 para más espacio entre botones --}}
                    style="background-color: #a56607; color: #fff; border: none;">Volver</a>
                {{-- <button type="submit" class="btn btn-primary">Generar</button> --}}
            </div>
@endsection