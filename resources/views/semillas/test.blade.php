@extends('layout.layout')

@section('title', 'Resultado del Test Chi-Cuadrado')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Resultado del Test Chi-Cuadrado</h2>

    <!-- Información de la semilla -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <strong>Información de la Semilla</strong>
        </div>
        <div class="card-body">
            <p><strong>Semilla ID:</strong> {{ $semilla->id }}</p>
            <p><strong>V1:</strong> {{ $semilla->v1 }}</p>
            <p><strong>V2:</strong> {{ $semilla->v2 }}</p>
            <p><strong>Módulo (m):</strong> {{ $semilla->m }}</p>
        </div>
    </div>

    <!-- Lista de números generados -->
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
    <div class="alert {{ $resultado ? 'alert-success' : 'alert-danger' }}">
        <strong>{{ $resultado ? '¡Éxito!' : 'Atención:' }}</strong>
        {{ $resultado ? 'Los números PASARON el test de Chi-Cuadrado.' : 'Los números NO pasaron el test de Chi-Cuadrado.' }}
    </div>

    <a href="{{ route('semillas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
