<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteDocumento extends Model
{
    protected $table = 'clientes_documentos';
    protected $fillable = [
        'cliente_id',
        'tipo_doc',
        'archivo'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
