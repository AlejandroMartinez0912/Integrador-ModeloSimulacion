@extends('layout.layout')

@section('title', 'Listado de Semillas')

@section('content')

    {{-- {{dd($semillas[0]->test->value)}} --}}
    <h1 class="mb-4">Semillas generadas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botón para generar una nueva semilla -->
    <div class="mb-3 text-end">
        <a href="{{ route('numeros.index') }}" class="btn btn-primary">Generar nueva semilla</a>
    </div>

    @if ($semillas->isEmpty())
        <p><strong>No hay semillas generadas. </strong>No hay semillas generadas.</p>
    @else
        <!-- Tabla con estilos modernos y responsive -->
        <div class="table-responsive">
            <table class="modern-table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Semilla</th>
                        <th>Constante A</th>
                        <th>Módulo</th>
                        <th>Generado el día</th>
                        <th>Test</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($semillas as $semilla)
                        <tr>
                            <td>{{ $semilla->id }}</td>
                            <td>{{ $semilla->v1 }}</td>
                            <td>{{ $semilla->v2 }}</td>
                            <td>{{ $semilla->m }}</td>
                            <td>{{ $semilla->created_at->format('d/m/Y') }}</td>
                            <td>{{ $semilla->test->value }}</td>
                            <td>
                                <a href="{{ route('semillas.detalles', $semilla->id) }}" class="action-btn">
                                    <i class="fas fa-eye"></i> Ver detalles
                                </a>
                                @if ($semilla->test->value == 'pendiente')
                                    <a href="{{ route('semillas.probar', $semilla->id) }}" class="action-btn">
                                        <i class="fas fa-chart-bar"></i> Probar Chi²
                                    </a>
                                @endif


                                <!-- Si semilla paso test, se puede ver la distribucion normal -->
                                @if ($semilla->test->value == 'aprobado')
                                    <a href="{{ route('distribucion.index', $semilla->id) }}" class="action-btn">
                                        <i class="fas fa-eye"></i> Distribucion Normal
                                    </a>
                                @endif
                                <!-- Revisar si esta bien la condicional -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif


    <!-- Agregar un espacio -->
    <div class="mt-4"></div>
    <!-- Botón volver -->
    <a href="/simulacion" class="btn me-2" style="background-color: #a56607; color: #fff; border: none;">Volver</a>
@endsection
