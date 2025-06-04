<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoVenta extends Model
{
    protected $table = 'estado_ventas';

    protected $fillable = [
        'nombre', 'descripcion', 'visible_cliente'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'estado_id');
    }
}
