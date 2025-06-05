<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;


class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
public function run()
{
    Empleado::create(['nombre' => 'Juan Pérez', 'email' => 'jperez@empresa.com']);
    Empleado::create(['nombre' => 'Ana Gómez', 'email' => 'agomez@empresa.com']);
}

}
