<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_servicio_id',
        'tipo_red',
        'ip_publica',
        'ip_privada',
        'gateway',
        'dns',
        'software_instalado',
        'accesos',
        'notas'
    ];

    public function poliza()
    {
        return $this->belongsTo(PolizaServicio::class, 'poliza_servicio_id');
    }
}
