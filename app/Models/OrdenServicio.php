<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'cliente_id',
        'tipo_cliente',
        'folio',
        'imei',
        'fecha_ingreso',
        'estado_id',
        'descripcion'
    ];

    public function estado()
    {
        return $this->belongsTo(EstadoOrdenServicio::class, 'estado_id');
    }
}
