<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_servicio_id',
        'nombre_usuario',
        'rol',
        'usuario_acceso',
        'password_acceso',
        'observaciones'
    ];

    public function poliza()
    {
        return $this->belongsTo(PolizaServicio::class, 'poliza_servicio_id');
    }
}
