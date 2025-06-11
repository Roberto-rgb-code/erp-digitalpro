<?php

// app/Models/ClienteFiscal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteFiscal extends Model
{
    protected $fillable = [
        'cliente_id', 'rfc', 'razon_social', 'uso_cfdi_id',
        'calle', 'numero', 'colonia', 'cp', 'municipio', 'estado'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function usoCfdi() {
        return $this->belongsTo(UsoCfdi::class, 'uso_cfdi_id');
    }
}
