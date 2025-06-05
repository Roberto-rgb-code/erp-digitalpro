<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $fillable = [
        'nombre','descripcion','valor','fecha'
    ];
}

