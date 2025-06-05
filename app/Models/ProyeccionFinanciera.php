<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProyeccionFinanciera extends Model
{
    protected $fillable = [
        'fecha','estimado_flujo','notas'
    ];
}

