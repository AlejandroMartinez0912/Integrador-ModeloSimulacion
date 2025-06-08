@extends('layout.layout')

@section('title', 'Generar Números Aleatorios')

@section('content')
    <div class="container mt-4">
        <h2>Generar Números Aleatorios - Congruencia Mixta</h2>

        <form action="{{ route('numeros.generar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="v1" class="form-label">Semilla (X₀)</label>
                <input type="number" class="form-control" name="v1" required>
            </div>

            <div class="mb-3">
                <label for="v2" class="form-label">Constante A</label>
                <input type="number" class="form-control" name="v2" required>
            </div>

            <div class="mb-3">
                <label for="m" class="form-label">Modulo M</label>
                <input type="number" class="form-control" name="m" required>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad de Números a Generar</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>

            <!-- Botónes -->
            <div class="d-flex justify-content-center">
                <!-- Botón volver -->
                <a href="{{route('semillas.index')}}" class="btn me-2" style="background-color: #a56607; color: #fff; border: none;">Volver</a>
                <!-- Botón para generar números -->
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
        </form>
    </div>
@endsection
