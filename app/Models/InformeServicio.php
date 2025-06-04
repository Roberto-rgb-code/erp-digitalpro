<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_servicio_id',
        'servicios_remoto_consumidos',
        'servicios_domicilio_consumidos',
        'servicios_remoto_contratados',
        'servicios_domicilio_contratados',
        'fecha_corte',
        'detalle'
    ];

    public function poliza()
    {
        return $this->belongsTo(PolizaServicio::class, 'poliza_servicio_id');
    }
}
