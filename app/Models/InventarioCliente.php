<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_servicio_id',
        'nombre_equipo',
        'tipo_equipo',
        'marca',
        'modelo',
        'numero_serie',
        'ip',
        'observaciones'
    ];

    public function poliza()
    {
        return $this->belongsTo(PolizaServicio::class, 'poliza_servicio_id');
    }
}
