<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AyudaController extends Controller
{
    //
    public function ayudaMetodoCongruencia()
    {
        return view('ayuda.ayuda_metodo_congruencia');
    }
    public function ayudaChiCuadrado($id){
        
        return view('ayuda.ayuda_prueba_chi_cuadrado',compact('id'));
    }
}
