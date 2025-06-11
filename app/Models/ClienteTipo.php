<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteTipo extends Model
{
    protected $fillable = ['nombre'];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_cliente_id');
    }
}
