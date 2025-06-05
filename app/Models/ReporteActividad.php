<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteActividad extends Model
{
    use HasFactory;

    protected $table = 'reporte_actividades';

    protected $fillable = [
        'proyecto_instalacion_id', 'empleado_id', 'fecha', 'actividad', 'notas', 'imagen', 'checklist'
    ];

    public function proyecto() {
        return $this->belongsTo(ProyectoInstalacion::class, 'proyecto_instalacion_id');
    }
    public function empleado() {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
