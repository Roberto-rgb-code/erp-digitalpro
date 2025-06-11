<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ClienteTipoSeeder::class,
            UsoCfdiSeeder::class,
            // Puedes agregar aquí más seeders de catálogos si los necesitas
        ]);
    }
}
