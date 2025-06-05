<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CuentaPorCobrar extends Model
{
    protected $fillable = [
        'cliente','monto','fecha_vencimiento','estado'
    ];
}
