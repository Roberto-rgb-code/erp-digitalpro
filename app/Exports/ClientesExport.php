<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cliente::with(['tipo', 'fiscal', 'credito'])->get()->map(function ($c) {
            return [
                'ID' => $c->id,
                'Folio' => $c->folio,
                'Nombre' => $c->nombre,
                'Tipo' => $c->tipo->nombre ?? '',
                'Teléfono' => $c->telefono,
                'Email' => $c->email,
                'Factura' => $c->configuracion?->requiere_factura ? 'Sí' : 'No',
                'RFC' => $c->fiscal->rfc ?? '',
                'Razón social' => $c->fiscal->razon_social ?? '',
                'Uso CFDI' => $c->fiscal->usoCfdi->clave ?? '',
                'Crédito' => $c->credito && $c->credito->tiene_linea ? $c->credito->limite_credito : 'N/A',
                'Días crédito' => $c->credito->dias_credito ?? '',
                'Fecha alta' => $c->fecha_alta,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'Folio', 'Nombre', 'Tipo', 'Teléfono', 'Email', 'Factura',
            'RFC', 'Razón social', 'Uso CFDI', 'Crédito', 'Días crédito', 'Fecha alta'
        ];
    }
}

