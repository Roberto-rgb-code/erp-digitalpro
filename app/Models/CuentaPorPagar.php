<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CuentaPorPagar extends Model
{
    protected $fillable = [
        'proveedor','monto','fecha_vencimiento','estado'
    ];
}
