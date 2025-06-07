<!-- Conexion a layout -->
@extends('layout.layout')

<!-- Titulo de la pagina -->
@section('title', 'Integrador de Modelos y Simulación')

<!-- Contenido de la pagina -->
@section('content')


    <h1 class="text-center">Integrador de Modelos y Simulación</h1>

    <h2 class="text-center"><strong>Modelo de existencia</strong></h2>


    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/escenario.jpg') }}" alt="Escenario" class="img-fluid" style="margin-top: 20px; margin-bottom: 20px ">
        </div>
        <div class="col-md-6">
            <p class="text-center" style="margin-top: 20px; margin-bottom: 20px ">
                Este proyecto simula la gestión de un almacén durante un año, con una existencia inicial de 2000 unidades. El objetivo es evaluar una política de inventario donde se hace un pedido cuando el stock cae por debajo de 300 unidades, solicitando la demanda de los últimos 5 días. La demanda diaria y el tiempo de entrega de los pedidos son aleatorios. La simulación detalla la situación diaria del inventario (demanda, ventas, desabastecimiento) y los eventos de pedidos, informando al final cuántas veces no se pudo satisfacer la demanda.
            </p> 

            <div class="text-center">
                <a href="/simulacion" class="btn btn-primary">Simular</a>
            </div>
        </div>
    </div>


@endsection