<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IngresoAdicional extends Model
{
    protected $fillable = [
        'descripcion','monto','fecha','tipo'
    ];
}
