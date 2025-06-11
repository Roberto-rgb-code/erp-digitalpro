<?php

// app/Models/UsoCfdi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoCfdi extends Model
{
    // ESTA LÍNEA ES CLAVE:
    protected $table = 'usos_cfdi';

    protected $fillable = ['clave', 'descripcion'];

    public function clienteFiscals() {
        return $this->hasMany(ClienteFiscal::class, 'uso_cfdi_id');
    }
}


