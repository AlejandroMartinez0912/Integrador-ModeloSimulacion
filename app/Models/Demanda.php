<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    //

    protected $table = 'demandas';
    protected $fillable = [
        'semilla_id',
        'stock_id',
        'num_dia',
        'cantidad_solicitada',
        'cantidad_cubierta',
        'estado',
        'fecha',
    ];

    // Relacion uno a muchos inversa con Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    //Relacion  uno a uno con Semilla
    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }

    // Relacion uno a uno con Venta
    public function venta()
    {
        return $this->hasOne(Venta::class);
    }
}
