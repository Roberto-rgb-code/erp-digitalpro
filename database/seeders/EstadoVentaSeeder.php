<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoVenta;

class EstadoVentaSeeder extends Seeder
{
    public function run()
    {
        $estados = [
            ['nombre' => 'Nueva', 'descripcion' => 'Venta registrada, pendiente de proceso'],
            ['nombre' => 'En proceso', 'descripcion' => 'En trámite o entrega'],
            ['nombre' => 'Facturada', 'descripcion' => 'Factura emitida'],
            ['nombre' => 'Pagada', 'descripcion' => 'Venta pagada por el cliente'],
            ['nombre' => 'Cancelada', 'descripcion' => 'Venta anulada'],
        ];

        foreach($estados as $estado) {
            EstadoVenta::firstOrCreate(['nombre' => $estado['nombre']], $estado);
        }
    }
}
