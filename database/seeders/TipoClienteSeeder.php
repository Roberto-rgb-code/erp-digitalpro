<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCliente;

class TipoClienteSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['Usuario final', 'Autoempleado', 'Empresa'];
        foreach ($tipos as $tipo) {
            TipoCliente::firstOrCreate(['nombre' => $tipo]);
        }
    }
}
