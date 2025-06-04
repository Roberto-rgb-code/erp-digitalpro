<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteFiscal extends Model
{
    protected $table = 'clientes_fiscales';
    protected $fillable = [
        'cliente_id',
        'rfc',
        'razon_social',
        'uso_cfdi',
        'direccion_fiscal'
    ];

    // Relación inversa: el registro fiscal pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
