<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioProyecto extends Model
{
    use HasFactory;

    protected $table = 'inventario_proyectos';

    protected $fillable = [
        'proyecto_instalacion_id', 'nombre', 'cantidad', 'unidad', 'consumido', 'faltante'
    ];

    public function proyecto() {
        return $this->belongsTo(ProyectoInstalacion::class, 'proyecto_instalacion_id');
    }
}
