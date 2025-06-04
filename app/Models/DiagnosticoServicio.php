<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoServicio extends Model
{
    use HasFactory;

    protected $table = 'diagnosticos_servicio';

    protected $fillable = [
        'orden_servicio_id',
        'problema',
        'solucion',
        'observaciones'
    ];

    public function orden()
    {
        return $this->belongsTo(OrdenServicio::class, 'orden_servicio_id');
    }
}
