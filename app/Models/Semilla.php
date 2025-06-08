<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semilla extends Model
{
    /* Este Modelo representa la tabla 'semillas' 
       para realizar el metodo de Congruencia Mixta
       generar los numeros aleatorios.
    */
    protected $table = 'semillas';
    protected $fillable = [
        'v1', // Valor 1, que es X0
        'v2', // Valor 2, que es constante A
        'm',
    ];

    //Relacion uno a muchos con Numeros
    public function numeros()
    {
        return $this->hasMany(Numero::class);
    }

    // Relación uno a muchos con MarcaClase
    public function marcaClases()
    {
        return $this->hasMany(MarcaClase::class);
    }
}
