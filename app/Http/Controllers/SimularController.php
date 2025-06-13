<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Semilla;

class SimularController extends Controller
{
    // Index de simulacion
    public function index() {
        // Obtenemos todas las semillas generadas
        $semillas = Semilla::all();

        return view('simular.index')->with('semillas', $semillas);
    }
}
