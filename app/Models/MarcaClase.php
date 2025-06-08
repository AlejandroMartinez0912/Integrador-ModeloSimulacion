<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaClase extends Model
{
    //
    protected $table = 'marca_clases';
    protected $fillable = [
        'semilla_id',
        'clase',
        'limite_inferior',
        'limite_superior',
        'marca_clase',
    ];

    // Relación con Semilla
    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }
}
