@extends('layout.layout')

@section('title', 'Resultado de la Simulación')

@section('content')
    {{-- {{dd($resultados[0]['pedido'])}} --}}
    <h2 class="text-center mb-4">Resultado de la Simulación</h2>
    <div class="alert alert-secondary">
        <strong>Umbral de stock para realizar pedidos:</strong> {{ $umbralPedido }}
    </div>

    <table class="table table-bordered table-hover table-sm">
        <thead class="table-dark text-center align-middle">
            <tr>
                <th>Día</th>
                <th>Existencia Inicial</th>
                <th>Demanda (N° Aleat.)</th>
                <th>Demanda</th>
                <th>Venta</th>
                <th>Demanda Insatisfecha</th>
                <th>Existencia Final</th>
                <th>¿Pedido?</th>
                <th>Demora (N° Aleat.)</th>
                <th>Demora (días)</th>
                <th>Cantidad Pedida</th>
                <th>Día de Llegada</th>
            </tr>
        </thead>
        <tbody class="text-end">
            @foreach ($resultados as $fila)
                <tr @if ($fila['pedido']) style="background-color: #e8f7ff;" @endif>
                    <td class="text-center">{{ $fila['dia'] }}</td>
                    <td>{{ number_format($fila['existencia_inicial'], 2) }}</td>
                    <td>{{ number_format($fila['rand_demanda'], 4) }}</td>
                    <td>{{ number_format($fila['demanda'], 2) }}</td>
                    <td>{{ number_format($fila['venta'], 2) }}</td>
                    <td>{{ number_format($fila['demanda_insatisfecha'], 2) }}</td>
                    <td>{{ number_format($fila['existencia_final'], 2) }}</td>
                    <td class="text-center">
                        {!! $fila['pedido'] === 'Sí'
                            ? '<span title="Pedido realizado" style="color:green;">&#x1F4E6;</span>'
                            : '<span title="Sin pedido" style="color:red;">&#x274C;</span>' !!}
                    </td>
                    <td>{{ $fila['rand_demora'] !== null ? number_format($fila['rand_demora'], 4) : '-' }}</td>
                    <td>{{ $fila['demora'] ?? '-' }}</td>
                    <td>{{ $fila['cantidad_pedida'] !== null ? number_format($fila['cantidad_pedida'], 2) : '-' }}</td>
                    <td>{{ $fila['dia_llegada'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $resultados->links() }}
    </div>

    <!-- Resumen -->
    <div>
        <div class="alert alert-info mt-4">
            <strong>Total de demandas insatisfechas:</strong> {{ $demandaNoSatisfecha }}
        </div>
        <div class="alert alert-warning">
            <strong>Unidades totales insatisfechas:</strong> {{ $unidadesInsatisfechas }}
        </div>
        @if (isset($recomendacionFija))
            <div class="alert alert-success">
                <strong>Recomendación con umbral fijo (300):</strong><br>
                Stock inicial sugerido: {{ $recomendacionFija['stock_inicial'] }} unidades<br>
                Unidades insatisfechas: {{ $recomendacionFija['unidades_insatisfechas'] }}
            </div>
        @endif

        @if (isset($recomendacionUsuario))
            <div class="alert alert-success">
                <strong>Recomendación con umbral personalizado ({{ $recomendacionUsuario['umbral'] }}):</strong><br>
                Stock inicial sugerido: {{ $recomendacionUsuario['stock_inicial'] }} unidades<br>
                Unidades insatisfechas: {{ $recomendacionUsuario['unidades_insatisfechas'] }}
            </div>
        @endif

    </div>

    <div class="alert alert-warning mt-4">
        @if (isset($frecuencias))
            <div class="mt-5">
                <h4>Frecuencias de Demanda</h4>
                <canvas id="graficoFrecuencia" height="100"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('graficoFrecuencia').getContext('2d');

                const observadas = {!! json_encode(array_values($frecuencias['observadas'])) !!};
                const esperadas = {!! json_encode(array_values($frecuencias['esperadas'])) !!};
                const totalObservadas = observadas.reduce((a, b) => a + b, 0);
                const totalEsperadas = esperadas.reduce((a, b) => a + b, 0);

                const data = {
                    labels: {!! json_encode(array_keys($frecuencias['observadas'])) !!},
                    datasets: [{
                            label: 'Frecuencia Observada (Simulación)',
                            data: observadas.map(val => val / totalObservadas),
                            borderColor: 'orange',
                            tension: 0.4,
                            fill: false
                        },
                        {
                            label: 'Frecuencia Esperada',
                            data: esperadas.map(val => val / totalEsperadas),
                            borderColor: 'deepskyblue',
                            tension: 0.4,
                            fill: false
                        }
                    ]
                };

                new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Comparación de Distribuciones de Probabilidad'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Intervalos de Caudal'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Probabilidad'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endif
    </div>




    <a href="{{ route('simular.index') }}" class="btn btn-secondary mt-3">← Volver a Simular</a>




@endsection
