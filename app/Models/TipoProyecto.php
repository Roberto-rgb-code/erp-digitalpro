<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    use HasFactory;

    protected $table = 'tipo_proyectos';
    protected $fillable = ['nombre'];

    public function proyectos()
    {
        return $this->hasMany(\App\Models\ProyectoInstalacion::class, 'tipo_proyecto_id');
    }
}

