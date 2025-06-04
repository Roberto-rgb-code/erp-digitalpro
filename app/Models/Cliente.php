<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'tipo_cliente_id',
        'telefono',
        'email',
        'requiere_factura',
        'fecha_alta',
        'activo',
        // no incluyas 'folio' aquí, se llena solo
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_cliente_id');
    }

    public function fiscal()
    {
        return $this->hasOne(ClienteFiscal::class, 'cliente_id');
    }

    public function credito()
    {
        return $this->hasOne(ClienteCredito::class, 'cliente_id');
    }

    public function documentos()
    {
        return $this->hasMany(ClienteDocumento::class, 'cliente_id');
    }

    // Folio automático
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cliente) {
            // Asegura que fecha_alta esté antes del folio
            if (!$cliente->fecha_alta) {
                $cliente->fecha_alta = now();
            }
            $anio = \Carbon\Carbon::parse($cliente->fecha_alta)->format('Y');
            $consecutivo = self::whereYear('fecha_alta', $anio)->count() + 1;
            $cliente->folio = 'CLI-' . $anio . '-' . str_pad($consecutivo, 6, '0', STR_PAD_LEFT);
        });
    }
}
