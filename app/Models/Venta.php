<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'fecha_venta',
        'estado_id',
        'total',
        'facturado',
        'pagado',
        'observaciones',
        'usuario_id',
        // el folio NO se debe poner aquí, se genera automático
    ];

    // Folio automático al crear
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($venta) {
            if (!$venta->fecha_venta) {
                $venta->fecha_venta = now();
            }
            $anio = Carbon::parse($venta->fecha_venta)->format('Y');
            $consecutivo = self::whereYear('fecha_venta', $anio)->count() + 1;
            $venta->folio = 'VEN-' . $anio . '-' . str_pad($consecutivo, 6, '0', STR_PAD_LEFT);
        });
    }

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function estado()
    {
        return $this->belongsTo(EstadoVenta::class, 'estado_id');
    }
    public function productos()
    {
        return $this->hasMany(ProductoVenta::class);
    }
    public function documentos()
    {
        return $this->hasMany(DocumentoVenta::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
