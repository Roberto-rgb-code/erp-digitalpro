<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rentabilidad extends Model
{
    protected $fillable = [
        'linea_negocio','ingresos','egresos','utilidad_neta','fecha'
    ];
}

