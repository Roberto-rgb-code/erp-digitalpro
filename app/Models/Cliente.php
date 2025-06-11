<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'folio',
        'nombre',
        'tipo_cliente_id',
        'telefono',
        'email',
        'fecha_alta',
    ];

    // Relaciones principales
    public function tipo()
    {
        return $this->belongsTo(ClienteTipo::class, 'tipo_cliente_id');
    }

    public function configuracion()
    {
        return $this->hasOne(ClienteConfiguracion::class);
    }

    public function fiscal()
    {
        return $this->hasOne(ClienteFiscal::class);
    }

    public function credito()
    {
        return $this->hasOne(ClienteCredito::class);
    }

    public function documentos()
    {
        return $this->hasMany(ClienteDocumento::class);
    }

    // Método para generar folio automático
    public static function generarFolio()
    {
        $ultimo = self::orderByDesc('id')->first();
        $num = $ultimo ? $ultimo->id + 1 : 1;
        return 'CLI' . str_pad($num, 6, '0', STR_PAD_LEFT);
    }
}
