<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolizaServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipo_poliza',
        'servicios_restantes_remoto',
        'servicios_restantes_domicilio',
        'fecha_inicio',
        'fecha_fin',
        'activa'
    ];

    // Relación: una póliza pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
