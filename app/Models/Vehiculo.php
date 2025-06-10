<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'nombre', 'marca', 'modelo', 'anio', 'placas',
        'responsable_id', 'estado', 'kilometraje_actual'
    ];

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id');
    }

    public function consumos()
    {
        return $this->hasMany(ConsumoCombustible::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(MantenimientoVehiculo::class);
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciaVehiculo::class);
    }

    public function usos()
    {
        return $this->hasMany(UsoVehiculo::class);
    }
}

