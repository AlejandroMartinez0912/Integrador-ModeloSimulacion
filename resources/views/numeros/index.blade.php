@extends('layout.layout')

@section('title', 'Generar Números Aleatorios')

@section('content')
    <div class="container mt-4">
        <h2>Generar Números Aleatorios - Congruencia Mixta</h2>

        <form action="{{ route('numeros.generar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="v1" class="form-label">Semilla (X₀)</label>
                <input type="number" class="form-control" name="v1" value="{{ old('v1') }}" required>
                @error('v1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="v2" class="form-label">Constante A</label>
                <input type="number" class="form-control" name="v2" value="{{old('v2')}}" required>
                @error('v2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="m" class="form-label">Modulo M</label>
                <input type="number" class="form-control" name="m" value="{{ old('m') }}" required>
                @error('m')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad de Números a Generar</label>
                <input type="number" class="form-control" name="cantidad" value="{{old('cantidad')}}" required>
                @error('cantidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botónes -->
            <div class="d-flex justify-content-center">
                <!-- Botón volver -->
                <a href="{{ route('semillas.index') }}" class="btn me-2"
                    style="background-color: #a56607; color: #fff; border: none;">Volver</a>
                <!-- Botón para generar números -->
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
        </form>

        <!-- Espacio -->
        <div class="mt-4"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>
@endsection
