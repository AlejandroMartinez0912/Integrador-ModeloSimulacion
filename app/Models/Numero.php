<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    //
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
