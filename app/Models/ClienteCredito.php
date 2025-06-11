<?php

// app/Models/ClienteCredito.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteCredito extends Model
{
    protected $fillable = ['cliente_id', 'tiene_linea', 'limite_credito', 'dias_credito'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
