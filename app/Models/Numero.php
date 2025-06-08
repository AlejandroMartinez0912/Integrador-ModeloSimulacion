<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    /* Este Modelo representa la tabla 'numeros'
       para almacenar los resultados de la generacion
       de numeros aleatorios mediante el metodo de Congruencia Mixta.
    */
    protected $table = 'numeros';
    protected $fillable = [
        'resultados',
        'semilla_id',
        'test',

    ];

    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }
}
