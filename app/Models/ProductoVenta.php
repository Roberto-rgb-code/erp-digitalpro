<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoVenta extends Model
{
    protected $table = 'producto_ventas';

    protected $fillable = [
        'venta_id', 'producto', 'cantidad', 'precio_unitario', 'subtotal'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
