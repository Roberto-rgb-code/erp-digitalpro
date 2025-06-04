<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteCredito extends Model
{
    protected $table = 'clientes_credito';
    protected $fillable = [
        'cliente_id',
        'tiene_linea',
        'limite_credito',
        'dias_credito'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
