<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoInstalacion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_instalacion';

    protected $fillable = [
        'nombre', 'cliente_id', 'tipo_proyecto_id', 'direccion',
        'fecha_inicio', 'fecha_fin', 'responsable_id', 'estado'
    ];

    // Relaciones
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
    public function tipoProyecto() {
        return $this->belongsTo(TipoProyecto::class, 'tipo_proyecto_id');
    }
    public function responsable() {
        return $this->belongsTo(Empleado::class, 'responsable_id');
    }
    public function inventarios() {
        return $this->hasMany(InventarioProyecto::class, 'proyecto_instalacion_id');
    }
    public function reportes() {
        return $this->hasMany(ReporteActividad::class, 'proyecto_instalacion_id');
    }
}

