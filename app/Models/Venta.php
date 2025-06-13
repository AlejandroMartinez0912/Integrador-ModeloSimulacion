<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'ventas';

    protected $fillable = [
        'demanda_id',
        'cantidad',
        'fecha',
    ];

    // Relacion uno a uno con Demanda
    public function demanda()
    {
        return $this->belongsTo(Demanda::class);
    }

}
