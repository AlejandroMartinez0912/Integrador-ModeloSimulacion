@extends('layout.layout')

@section('title', 'Generar Números Aleatorios')

@section('content')
    <div class="container mt-4 p-4 rounded-3 shadow-lg"> {{-- Agregamos container para centralizar y dar estilo --}}
        <h2 class="mb-4 text-center">Generar Números Aleatorios - Congruencia Mixta</h2>

        <form action="{{ route('numeros.generar') }}" method="POST">
            @csrf

            {{-- Usamos un row para el diseño de columnas --}}
            <div class="row">
                <div class="col-md-6 mb-3"> {{-- Columna para la Semilla --}}
                    <label for="v1" class="form-label">Semilla (X₀)</label>
                    <input type="number" class="form-control" name="v1" value="{{ old('v1') }}" required>
                    @error('v1')
                        <div class="invalid-feedback d-block">{{ $message }}</div> {{-- d-block para mostrar feedback --}}
                    @enderror
                </div>

                <div class="col-md-6 mb-3"> {{-- Columna para la Constante A --}}
                    <label for="v2" class="form-label">Constante A</label>
                    <input type="number" class="form-control" name="v2" value="{{ old('v2') }}" required>
                    @error('v2')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div> {{-- Fin de la primera fila --}}

            <div class="row">
                <div class="col-md-6 mb-3"> {{-- Columna para la Constante Aditiva (C) --}}
                    <label for="c" class="form-label">Constante aditiva (C)</label>
                    <input type="number" class="form-control" id="c" name="c" value="{{ old('c') }}" required>
                    @error('c')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3"> {{-- Columna para el Módulo M --}}
                    <label for="m" class="form-label">Modulo M</label>
                    <input type="number" class="form-control" name="m" value="{{ old('m') }}" required>
                    @error('m')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div> {{-- Fin de la segunda fila --}}

            <div class="row">
                <div class="col-md-6 mb-3"> {{-- Columna para la Cantidad de Números --}}
                    <label for="cantidad" class="form-label">Cantidad de Números a Generar</label>
                    <input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Opcional: si quieres el último campo centrado o en su propia fila, no lo metas en una columna aquí.
                -- Si no hay otro campo en esta fila, esta columna ocupará su espacio disponible. --}}
            </div> {{-- Fin de la tercera fila --}}

            <div class="d-flex justify-content-center mt-4"> {{-- Agregamos mt-4 para espacio superior --}}
                <a href="{{ route('semillas.index') }}" class="btn me-3" {{-- me-3 para más espacio entre botones --}}
                    style="background-color: #a56607; color: #fff; border: none;">Volver</a>
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
        </form>

        {{-- Los mensajes de error de Laravel ya están manejados por SweetAlert en layout.blade.php
             y se muestran bajo cada input con 'invalid-feedback d-block'.
             Este bloque de errores generales es redundante si solo usas SweetAlert para errores generales
             o si los errores de validación están bajo cada input.
             Lo comentamos o eliminamos si solo quieres los errores bajo cada input.
        --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
    </div> {{-- Cierre del container --}}
@endsection
