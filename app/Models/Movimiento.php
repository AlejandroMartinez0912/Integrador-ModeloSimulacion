<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    protected $table = 'movimientos';
    
    protected $fillable = [
        'venta_id', // Relación con Venta
        'pedido_id', // Relación con Pedido
        'stock_id', // Relación con Stock
        'tipo_movimiento', // Puede ser 'entrada' o 'salida'
        'cantidad',
    ];


    // Relación uno a uno con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
    // Relación uno a uno con Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    // Relación uno a uno con Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    
}
