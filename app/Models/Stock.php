<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = 'stocks';

    protected $fillable = [
        'cantidad',
        'producto',
    ];


    // Relacion uno a muchos con Demanda
    public function demandas()
    {
        return $this->hasMany(Demanda::class);
    }
}
