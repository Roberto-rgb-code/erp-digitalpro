<?php

// app/Models/ClienteDocumento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteDocumento extends Model
{
    protected $fillable = ['cliente_id', 'tipo_doc', 'archivo'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
