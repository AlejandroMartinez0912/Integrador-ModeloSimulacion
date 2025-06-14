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
        $request->validate(
            [
                'v1' => 'required|numeric',
                'v2' => 'required|numeric',
                'c' => 'required|numeric|min:0',
                'm' => 'required|numeric|min:1',
                'cantidad' => 'required|numeric|min:1|max:10000',
            ],
            [
                'v1.required' => 'La semilla (X₀) es requerida.',
                'v2.required' => 'La constante (A) es requerida.',
                'm.required' => 'El módulo (m) es requerido.',
                'cantidad.required' => 'La cantidad de números a generar es requerida.',
                'v1.numeric' => 'La semilla (X₀) debe ser un número.',
                'v2.numeric' => 'La constante (A) debe ser un número.',
                'm.numeric' => 'El módulo (m) debe ser un número.',
                'cantidad.numeric' => 'La cantidad de números a generar debe ser un número.',
                'm.min' => 'El módulo (m) debe ser al menos 1.',
                'cantidad.min' => 'La cantidad de números a generar debe ser al menos 1.',
                'cantidad.max' => 'La cantidad de números a generar no puede exceder 10,000.',
                'c.min' => 'La constante (C) debe ser al menos 0.',
            ]
        );

        $x0 = (int)$request->v1;
        $a  = (int)$request->v2;
        $m  = (int)$request->m;
        $c  = (int)$request->c;

        // Validación: X₀ debe ser mayor que 0 y menor que m
        if ($x0 <= 0 || $x0 >= $m) {
            return back()->withErrors(['v1' => 'La semilla (X₀) debe ser mayor que 0 y menor que el módulo (m).'])->withInput();
        }

        // Validación: a > 0
        if ($a <= 0) {
            return back()->withErrors(['v2' => 'La constante (A) debe ser mayor que 0.'])->withInput();
        }


        // Validación: c y m deben ser primos relativos
        if ($generador->mcd($c, $m) != 1) {
            return back()->withErrors(['c' => 'La constante (C) y el módulo (m) deben ser primos relativos (su MCD debe ser 1).'])->withInput();
        }

        // Validación: evitar todos pares
        if ($a % 2 === 0 && $x0 % 2 === 0 && $m % 2 === 0) {
            return back()->withErrors(['v2' => 'La constante (A), el módulo (m) y la semilla (X₀) no deben ser todos pares, ya que la secuencia será pobre.'])->withInput();
        }

        // Creamos la semilla
        //NOTA: el valor de test se inicializa como pendiente, es valor por defecto en la migracion
        $semilla = Semilla::create([
            'v1' => $x0,
            'v2' => $a,
            'c'  => $c,
            'm'  => $m,
            'cantidad' => $request->cantidad
        ]); 
 
        // Generamos los números
        $numeros = $generador->generar($x0, $a, $c, $m, $request->cantidad);


        foreach ($numeros as $num) {
            Numero::create([
                'semilla_id' => $semilla->id,
                'resultados' => $num,
                'test' => 'pendiente',
            ]);
        }

        return redirect()->route('semillas.index')->with('success', 'Números generados correctamente.');
    }


    public function listarSemillas()
    {
        // Obtenemos todas las semillas generadas
        $semillas = Semilla::all();


        return view('semillas.index', compact('semillas',));
    }

    public function verDetalles($id)
    {
        $semilla = Semilla::findOrFail($id);
        $numeros = $semilla->numeros()->get();
        $estadoTest = $semilla->test->value;
        return view('semillas.detalles', compact('semilla', 'numeros', 'estadoTest'));
    }
}
