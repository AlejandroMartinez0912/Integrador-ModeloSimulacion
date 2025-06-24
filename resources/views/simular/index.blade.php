@extends('layout.layout')

@section('title', 'Simular')

@section('content')

    <h2 class="text-center">Registrar datos que se desean simular</h2>

    <div class="text-center">
        <!-- form para registrar los datos que se desean simular -->
        <form action="{{ route('simular.simular') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"> <!-- Fila 1, Columna 1 -->
                    <label for="producto" class="form-label">Producto</label>
                    <input type="string" class="form-control" id="producto" name="producto" required
                        placeholder="Ingrese el nombre del producto">
                </div>
                <div class="col-md-6 mb-3"> <!-- Fila 1, Columna 2 -->
                    <label for="cantidad" class="form-label">Cantidad inicial</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad_inicial" required
                        placeholder="Ingrese la cantidad inicial de stock">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="umbral_pedido" class="form-label">Umbral de Stock para Pedido</label>
                    <input type="number" name="umbral_pedido" id="umbral_pedido" class="form-control" value="300"
                        min="1" required>
                    <small class="form-text text-muted">Cuando el stock sea menor a este valor, se realizará un nuevo
                        pedido.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <!-- Una columna para el select, ocupando la mitad del ancho en md y superior -->
                    <label for="semilla" class="form-label">Seleccione la semilla</label>
                    <select class="form-select" id="semilla" name="semilla" required
                        placeholder="Seleccione la semilla a simular">
                        @foreach ($semillas as $semilla)
                            <option value="{{ $semilla->id }}">{{ $semilla->id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Simulación</button>
        </form>
    </div>
    <!-- Enlace para volver a la pantalla de inicio -->
    <!-- Agregar un espacio -->
    <div class="mt-4"></div>
    <!-- Botón volver -->
    <a href="/simulacion" class="btn me-2" style="background-color: #a56607; color: #fff; border: none;">Volver</a>
@endsection
