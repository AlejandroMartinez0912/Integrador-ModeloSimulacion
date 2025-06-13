<!-- Conexion a layout -->
@extends('layout.layout')

<!-- Titulo de la pagina -->
@section('title', 'Simulacion')

<!-- Contenido de la pagina -->
@section('content')
<!-- elementos al centro -->

    <div class="container mt-4"> <div class="row align-items-center"> <div class="col-auto">
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
                <a href="{{route('semillas.index')}}" class="btn btn-primary">Generar Numeros Aleatorios</a>
            </div>
        </div>

        <div class="row" style="margin-top: 30px; margin-bottom: 20px ">
            <div class="col-md-6">
                <h4 class="text-center">Simular</h4>
                <p class="text-center">Se realiza la simulacion del inventario utilizando los numeros aleatorios, la demanda y el tiempo de entrega de los pedidos</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('simular.index')}}" class="btn btn-primary">Simular</a>
            </div>
        </div>


    </div>

@endsection