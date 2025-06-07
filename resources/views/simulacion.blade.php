<!-- Conexion a layout -->
@extends('layout.layout')

<!-- Titulo de la pagina -->
@section('title', 'Simulacion')

<!-- Contenido de la pagina -->
@section('content')
<!-- elementos al centro -->

    <div class="container mt-4"> <div class="row align-items-center"> <div class="col-auto"> <a href="/" class="btn btn-secondary">Volver</a>
            </div>

            <div class="col text-center"> <h1>Simulación</h1>
            </div>

            <div class="col-auto"> </div>

        </div>
    </div>


    <!-- botones de navegacion -->

    <div class="text-center" style="margin-top: 50px; margin-bottom: 20px ">
        <div class="row" style="margin-top: 30px; margin-bottom: 20px ">
            <div class="col-md-6">
                <h4 class="text-center">Numeros Aleatorios</h4>
                <p class="text-center">Los numeros aleatorios se usan para generar la demanda y el tiempo de entrega de los pedidos</p>
            </div>
            <div class="col-md-6">
                <a href="/numeros-aleatorios" class="btn btn-primary">Generar Numeros Aleatorios</a>
            </div>
        </div>

        <div class="row" style="margin-top: 30px; margin-bottom: 20px ">
            <div class="col-md-6">
                <h4 class="text-center">Stock</h4>
                <p class="text-center">El stock se actualiza con la demanda y la venta</p>
            </div>
            <div class="col-md-6">
                <a href="/stock" class="btn btn-primary">Stock</a>
            </div>
        </div>

        <div class="row" style="margin-top: 30px; margin-bottom: 20px ">
            <div class="col-md-6">
                <h4 class="text-center">Demanda</h4>
                <p class="text-center">La demanda se actualiza con la demanda y la venta</p>
            </div>
            <div class="col-md-6">
                <a href="/demanda" class="btn btn-primary">Demanda</a>
            </div>
        </div>

        <!-- Venta -->
         <div class="row" style="margin-top: 30px; margin-bottom: 20px ">
            <div class="col-md-6">
                <h4 class="text-center">Venta</h4>
                <p class="text-center">Venta de productos</p>
            </div>
            <div class="col-md-6">
                <a href="/venta" class="btn btn-primary">Venta</a>
            </div>
         </div>

    </div>

@endsection