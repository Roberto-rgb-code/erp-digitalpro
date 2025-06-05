<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoSoftware extends Model
{
    protected $table = 'proyecto_software';
    protected $fillable = [
        'nombre', 'cliente_id', 'tipo_software_id', 'stack', 'fecha_inicio', 'fecha_entrega',
        'responsable_id', 'estado', 'historial'
    ];

    // Relaciones
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function tipo() {
        return $this->belongsTo(TipoSoftware::class, 'tipo_software_id');
    }
    public function responsable() {
        return $this->belongsTo(Empleado::class, 'responsable_id');
    }
    public function modulos() {
        return $this->hasMany(ModuloSoftware::class, 'proyecto_software_id');
    }
}

