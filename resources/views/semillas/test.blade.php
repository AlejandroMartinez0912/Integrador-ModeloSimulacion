@extends('layout.layout')

@section('title', 'Resultado del Test Chi-Cuadrado')

@section('content')
    <h2 class="mb-4">Resultado del Test Chi-Cuadrado</h2>

    <!-- Información de la semilla -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <strong>Información de la Semilla</strong>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-3">
                <p><strong>Semilla ID:</strong> {{ $semilla->id }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>V1:</strong> {{ $semilla->v1 }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>V2:</strong> {{ $semilla->v2 }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Módulo (m):</strong> {{ $semilla->m }}</p>
            </div>
            </div>
        </div>
    </div>

    <!-- Números generados -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <strong>Números Generados</strong>
        </div>
        <div class="card-body">
            @if ($numeros->isEmpty())
                <p>No hay números generados para esta semilla.</p>
            @else
                <ul class="list-group">
                    @foreach ($numeros as $index => $numero)
                        <li class="list-group-item">#{{ $index + 1 }} → {{ $numero->resultados }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Resultado del test -->
    <div class="alert {{ $resultado['pasa'] ? 'alert-success' : 'alert-danger' }}">
        <strong>{{ $resultado['pasa'] ? '¡Éxito!' : 'Atención:' }}</strong>
        {{ $resultado['pasa'] ? 'Los números PASARON el test de Chi-Cuadrado.' : 'Los números NO pasaron el test de Chi-Cuadrado.' }}
    </div>

    <!-- Datos estadísticos -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <strong>Detalles Estadísticos del Test</strong>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-6">
                <p><strong>χ² calculado:</strong> {{ $resultado['chiCuadrado'] }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Valor crítico (α = 0.05):</strong> {{ $resultado['valorCritico'] }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Grados de libertad:</strong> {{ $resultado['gl'] }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Frecuencia esperada por clase:</strong> {{ $resultado['frecuenciaEsperada'] }}</p>
            </div>
            </div>
        </div>
    </div>

    <!-- Frecuencias observadas -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Frecuencias Observadas por Clase</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Clase</th>
                        <th>Frecuencia Observada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultado['frecuenciasObservadas'] as $clase => $frecuencia)
                        <tr>
                            <td>{{ $clase + 1 }}</td>
                            <td>{{ $frecuencia }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('semillas.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
