<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //

    protected $table = 'pedidos';
    protected $fillable = [
        'semilla_id',
        'num_dia',
        'cantidad_solicitada',
        'cantidad_recibida',
        'estado',
        'demora',
        'fecha',
    ];

    // Relación uno a uno con Semilla
    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }

    


}
