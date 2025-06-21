<?php

namespace App\Http\Controllers;

use App\Enums\DemoraPedido;
use App\Models\Demanda;
use App\Models\Movimiento;
use App\Models\Pedido;
use App\Models\Semilla;
use App\Models\Stock;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Enums\TestSemilla;
use Illuminate\Pagination\LengthAwarePaginator;

class SimularController extends Controller
{
    public function index()
    {
        $semillas = Semilla::where('test', 'aprobado')->get();
        return view('simular.index', compact('semillas'));
    }

    public function simular(Request $request)
    {
        DB::beginTransaction();

        try {
            $producto = $request->input('producto');
            $cantidadInicial = (float) $request->input('cantidad_inicial');
            $semillaId = $request->input('semilla');

            $semilla = Semilla::findOrFail($semillaId);

            if ($semilla->test !== TestSemilla::Aprobado) {
                Session::flash('error', 'La semilla seleccionada no ha pasado el test de Chi-Cuadrado.');
                return redirect()->route('simular.index');
            }

            $stock = Stock::create([
                'producto' => $producto,
                'cantidad' => $cantidadInicial,
            ]);

            Movimiento::create([
                'stock_id' => $stock->id,
                'tipo' => 'ingreso_inicial',
                'cantidad' => $cantidadInicial,
            ]);

            $numeros = $semilla->numeros->pluck('resultados')->toArray();

            $demandaMedia = 150;
            $demandaDesv = 25;
            $demandaNoSatisfecha = 0;
            $unidadesInsatisfechas = 0;
            $pedidosPendientes = [];
            $resultados = [];

            for ($dia = 1; $dia <= 365; $dia++) {
                $existenciaInicialDelDia = $stock->cantidad;

                foreach ($pedidosPendientes as $key => $pedidoInfo) {
                    if ($pedidoInfo['dias_restantes'] === 0) {
                        $pedido = Pedido::create([
                            'semilla_id' => $pedidoInfo['semilla_id'],
                            'num_dia' => $dia,
                            'cantidad_solicitada' => $pedidoInfo['cantidad'],
                            'cantidad_recibida' => $pedidoInfo['cantidad'],
                            'estado' => 'satisfecha',
                            'demora' => $pedidoInfo['demora'],
                            'fecha' => Carbon::now()->addDays($dia),
                        ]);

                        Movimiento::create([
                            'stock_id' => $stock->id,
                            'tipo' => 'ingreso',
                            'cantidad' => $pedidoInfo['cantidad'],
                            'pedido_id' => $pedido->id,
                        ]);

                        $stock->increment('cantidad', $pedidoInfo['cantidad']);
                        unset($pedidosPendientes[$key]);
                    } else {
                        $pedidosPendientes[$key]['dias_restantes']--;
                    }
                }

                $u = $numeros[$dia % count($numeros)];
                $normal = $demandaMedia + $demandaDesv * sqrt(-2 * log($u)) * cos(2 * pi() * $u);
                $cantidadDemandada = max(0, round($normal));

                $cantidadCubierta = min($cantidadDemandada, $stock->cantidad);
                $estado = $cantidadCubierta < $cantidadDemandada ? 'insatisfecha' : 'satisfecha';

                if ($estado === 'insatisfecha') {
                    $demandaNoSatisfecha++;
                    $unidadesInsatisfechas += ($cantidadDemandada - $cantidadCubierta);
                }

                $demanda = Demanda::create([
                    'semilla_id' => $semilla->id,
                    'stock_id' => $stock->id,
                    'num_dia' => $dia,
                    'cantidad_solicitada' => $cantidadDemandada,
                    'cantidad_cubierta' => $cantidadCubierta,
                    'estado' => $estado,
                    'fecha' => Carbon::now()->addDays($dia),
                ]);

                if ($cantidadCubierta > 0) {
                    $venta = Venta::create([
                        'demanda_id' => $demanda->id,
                        'cantidad' => $cantidadCubierta,
                        'fecha' => Carbon::now()->addDays($dia),
                    ]);

                    Movimiento::create([
                        'stock_id' => $stock->id,
                        'tipo' => 'egreso',
                        'cantidad' => $cantidadCubierta,
                        'venta_id' => $venta->id,
                    ]);

                    $stock->decrement('cantidad', $cantidadCubierta);
                }

                $seHizoPedido = false;
                $r = null;
                $demora = null;
                $cantidadPedido = null;
                $diaLlegada = null;

                if ($stock->cantidad < 300) {
                    $seHizoPedido = true;

                    $r = mt_rand() / mt_getrandmax();
                    $demora = DemoraPedido::desdeProbabilidad($r)->value;

                    $promUltimos5 = array_slice($numeros, max(0, $dia - 5), 5);
                    $media = array_sum($promUltimos5) / count($promUltimos5);

                    $cantidadPedido = round($demandaMedia + $demandaDesv * sqrt(-2 * log($media)) * cos(2 * pi() * $media));
                    $diaLlegada = $dia + $demora;

                    $pedidosPendientes[] = [
                        'semilla_id' => $semilla->id,
                        'dias_restantes' => $demora,
                        'cantidad' => $cantidadPedido,
                        'demora' => $demora,
                    ];
                }

                $resultados[] = [
                    'dia' => $dia,
                    'existencia_inicial' => $existenciaInicialDelDia,
                    'rand_demanda' => $u,
                    'demanda' => $cantidadDemandada,
                    'venta' => $cantidadCubierta,
                    'demanda_insatisfecha' => $cantidadDemandada - $cantidadCubierta,
                    'existencia_final' => $stock->cantidad,
                    'pedido' => $seHizoPedido ? 'Sí' : 'No',
                    'rand_demora' => $r,
                    'demora' => $demora,
                    'cantidad_pedida' => $cantidadPedido,
                    'dia_llegada' => $diaLlegada,
                ];
            }

            DB::commit();

            // Guardar resultados en sesión
            Session::put('resultados_simulacion', $resultados);
            Session::put('producto', $producto);
            Session::put('cantidadInicial', $cantidadInicial);
            Session::put('demandaNoSatisfecha', $demandaNoSatisfecha);
            Session::put('unidadesInsatisfechas', $unidadesInsatisfechas);

            return redirect()->route('simular.resultado');

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('simular.index')->with('error', 'Error en la simulación: ' . $e->getMessage());
        }
    }

    public function resultado(Request $request)
    {
        $resultados = Session::get('resultados_simulacion', []);
        $producto = Session::get('producto');
        $cantidadInicial = Session::get('cantidadInicial');
        $demandaNoSatisfecha = Session::get('demandaNoSatisfecha');
        $unidadesInsatisfechas = Session::get('unidadesInsatisfechas');

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;

        $pagedResults = array_slice($resultados, ($page - 1) * $perPage, $perPage);
        $paginatedResults = new LengthAwarePaginator(
            $pagedResults,
            count($resultados),
            $perPage,
            $page,
            ['path' => route('simular.resultado')]
        );

        return view('simular.resultado', [
            'resultados' => $paginatedResults,
            'producto' => $producto,
            'cantidadInicial' => $cantidadInicial,
            'demandaNoSatisfecha' => $demandaNoSatisfecha,
            'unidadesInsatisfechas' => $unidadesInsatisfechas,
        ]);
    }
}
