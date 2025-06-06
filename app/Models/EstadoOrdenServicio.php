<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoOrdenServicio extends Model
{
    use HasFactory;

    protected $table = 'estados_orden_servicio';

    protected $fillable = ['nombre', 'color'];
}
