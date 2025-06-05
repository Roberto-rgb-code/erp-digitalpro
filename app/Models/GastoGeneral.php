<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GastoGeneral extends Model
{
    protected $fillable = [
        'tipo','categoria_id','proveedor','descripcion','monto','fecha'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaGasto::class, 'categoria_id');
    }
}

