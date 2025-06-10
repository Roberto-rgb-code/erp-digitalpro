<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuestoEmpleado extends Model
{
    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'puesto_empleado_id');
    }
}

