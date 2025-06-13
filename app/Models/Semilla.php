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
        'v1', // V1 es la semilla inicial
        'v2', // V2 es la constante multiplicativa
        'c', // C es la constante aditiva
        'm', // M es el modulo
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

    // Relacion uno a uno con Pedido
    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }

    // Relacion uno a uno con Demanda
    public function demanda()
    {
        return $this->hasOne(Demanda::class);
    }
}
