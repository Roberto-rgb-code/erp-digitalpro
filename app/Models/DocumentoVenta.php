<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoVenta extends Model
{
    protected $table = 'documento_ventas';

    protected $fillable = [
        'venta_id', 'tipo_doc', 'archivo'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
