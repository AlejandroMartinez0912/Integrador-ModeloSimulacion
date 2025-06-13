@extends('layout.layout')

@section('title', 'Detalles de Semilla')

@section('content')

        <h2>Detalles de la semilla #{{ $semilla->id }}</h2>
        <p><strong>V1:</strong> {{ $semilla->v1 }}</p>
        <p><strong>V2:</strong> {{ $semilla->v2 }}</p>
        <p><strong>M:</strong> {{ $semilla->m }}</p>
        <p><strong>Estado del Test:</strong> {{ $estadoTest }}</p>

        <h4 class="mt-4">Números generados:</h4>
        @if ($semilla->cantidad > 50)
           <!--  <p>Se mostrarán los 50 primeros resultados.</p> -->
        @endif
        
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($numeros as $index => $numero)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $numero->resultados }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Agregar un espacio -->
        <div class="mt-4"></div>
        <!-- Botón volver -->
        <a href="{{ route('semillas.index') }}" class="btn me-2"
            style="background-color: #a56607; color: #fff; border: none;">Volver</a>

@endsection
