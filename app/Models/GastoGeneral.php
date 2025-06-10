<?php

// app/Models/GastoGeneral.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastoGeneral extends Model
{
    protected $fillable = [
        'concepto', 'monto', 'fecha', 'categoria_id', 'proveedor_id', 'descripcion', 'documento'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaGasto::class, 'categoria_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Cliente::class, 'proveedor_id');
    }
}


