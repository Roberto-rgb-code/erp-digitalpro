<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['nombre', 'puesto_empleado_id', 'fecha_ingreso', 'estado', 'notas_internas'];

    public function puesto()
    {
        return $this->belongsTo(PuestoEmpleado::class, 'puesto_empleado_id');
    }
}

