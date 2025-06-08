<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semilla;
use App\Models\Numero;
use App\Services\GeneradorCongruenciaService;

class NumeroController extends Controller
{
    public function index()
    {
        return view('numeros.index');
    }

    public function generar(Request $request, GeneradorCongruenciaService $generador)
    {
        $request->validate([
            'v1' => 'required|numeric',
            'v2' => 'required|numeric',
            'm' => 'required|numeric',
            'cantidad' => 'required|numeric',
        ]);

        $semilla = Semilla::create([
            'v1' => $request->v1,
            'v2' => $request->v2,
            'm' => $request->m,
        ]);

        $numeros = $generador->generar($request->v1, $request->v2, $request->m, $request->cantidad);

        foreach ($numeros as $num) {
            Numero::create([
                'semilla_id' => $semilla->id,
                'resultados' => $num,
                'test' => 'pendiente', // se actualizará luego del test chi-cuadrado
            ]);
        }

        return redirect()->route('semillas.index')->with('success', 'Números generados correctamente.');
    }

    public function listarSemillas()
    {
        $semillas = Semilla::latest()->get();
        return view('semillas.index', compact('semillas'));
    }

    public function verDetalles($id)
    {
        $semilla = Semilla::findOrFail($id);
        $numeros = $semilla->numeros()->get();
        return view('semillas.detalles', compact('semilla', 'numeros'));

    }
}