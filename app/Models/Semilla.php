<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semilla extends Model
{
    //
        protected $table = 'semillas';
    protected $fillable = [
        'v1',
        'v2',
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
