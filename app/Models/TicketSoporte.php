<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSoporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_servicio_id',
        'folio',
        'titulo',
        'descripcion',
        'estado',
        'tecnico_id',
        'prioridad'
    ];

    public function poliza()
    {
        return $this->belongsTo(PolizaServicio::class, 'poliza_servicio_id');
    }
}
