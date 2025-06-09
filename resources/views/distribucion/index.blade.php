@extends('layout.layout')

@section('title', 'Resultados de Distribución Normal')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-auto">
            <a href="{{ route('semillas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="col text-center">
            <h1>Demanda con Distribución Normal</h1>
        </div>
        <div class="col-auto"></div> {{-- Columna vacía para alinear el título al centro --}}
    </div>

    <div class="container p-4 rounded-3 shadow-lg">
        <h2 class="mb-3 text-center">Detalles de la Semilla #{{ $semilla->id }}</h2>
        <p><strong>Semilla (X₀):</strong> {{ $semilla->v1 }}</p>
        <p><strong>Constante Multiplicativa (A):</strong> {{ $semilla->v2 }}</p>
        <p><strong>Constante Aditiva (C):</strong> {{ $semilla->c }}</p>
        <p><strong>Módulo (M):</strong> {{ $semilla->m }}</p>
        <hr class="my-4">

        <h3 class="mt-4 text-center">Parámetros de la Distribución Normal de la Demanda</h3>
        <p class="text-center">Estos parámetros son los utilizados para transformar los números uniformes a la demanda simulada.</p>
        <p class="text-center"><strong>Media deseada (μ):</strong> {{ $mean }} unidades por día</p>
        <p class="text-center"><strong>Desviación Estándar deseada (σ):</strong> {{ $stdDev }} unidades</p>
        <hr class="my-4">

        <h3 class="mt-4 text-center">Valores de Demanda Generados (Distribución Normal)</h3>
        <p class="text-center">Estos son los números aleatorios transformados para simular la demanda diaria. Se redondean a enteros, ya que la demanda de un producto es discreta.</p>
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Demanda Simulada (Unidades/Día)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($numerosNormales as $index => $normalNum)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{-- La demanda no puede ser negativa, y debe ser un número entero --}}
                        <td>{{ max(0, round($normalNum)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">No hay números normales generados o la semilla no pasó el test.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(!empty($marcasDeClasesDemanda))
            <h3 class="mt-4 text-center">Distribución de la Demanda por Marcas de Clases (Bins)</h3>
            <p class="text-center">Esta tabla muestra la frecuencia de las demandas simuladas dentro de rangos específicos.</p>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Clase Inferior</th>
                            <th>Clase Superior</th>
                            <th>Marca de Clase</th>
                            <th>Frecuencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marcasDeClasesDemanda as $clase)
                        <tr>
                            <td>{{ $clase['clase_inferior'] }}</td>
                            <td>{{ $clase['clase_superior'] }}</td>
                            <td>{{ $clase['marca_clase'] }}</td>
                            <td>{{ $clase['frecuencia'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center mt-4" role="alert">
                No se pudieron generar las marcas de clases para la demanda.
            </div>
        @endif
    </div>
@endsection
