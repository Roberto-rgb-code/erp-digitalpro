<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DocumentosFinancieros extends Model
{
    protected $fillable = [
        'nombre_archivo','tipo_documento','proveedor','gasto_general_id'
    ];

    public function gasto()
    {
        return $this->belongsTo(GastoGeneral::class, 'gasto_general_id');
    }
}
