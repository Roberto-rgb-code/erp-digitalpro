<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteTipoSeeder extends Seeder
{
    public function run()
    {
        DB::table('cliente_tipos')->upsert([
            ['nombre' => 'Usuario final'],
            ['nombre' => 'Autoempleado'],
            ['nombre' => 'Empresa'],
        ], ['nombre']);
    }
}
