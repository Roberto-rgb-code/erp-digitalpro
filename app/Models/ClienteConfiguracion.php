<?php

// app/Models/ClienteConfiguracion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteConfiguracion extends Model
{
    protected $table = 'cliente_configuraciones'; // <-- Esta línea es clave
    protected $fillable = ['cliente_id', 'requiere_factura'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}

