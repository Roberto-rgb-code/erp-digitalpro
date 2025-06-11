<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px 10px;
        }
        .title {
            text-align: left;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        th, td {
            border: 1px solid #888;
            padding: 6px 5px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background: #F1F1F1;
            font-size: 13px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 11px;
            border-radius: 5px;
            color: #fff;
        }
        .badge-success { background: #1abc9c; }
        .badge-danger { background: #e74c3c; }
        .badge-default { background: #888; }
    </style>
</head>
<body>
    <div class="title">Reporte de Clientes</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Factura</th>
                <th>RFC</th>
                <th>Razón social</th>
                <th>Uso CFDI</th>
                <th>Crédito</th>
                <th>Días crédito</th>
                <th>Fecha alta</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $c)
            <tr>
                <td class="text-center">{{ $c->id }}</td>
                <td>{{ $c->folio }}</td>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->tipo->nombre ?? '' }}</td>
                <td>{{ $c->telefono }}</td>
                <td>{{ $c->email }}</td>
                <td>
                    @if($c->configuracion?->requiere_factura)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-default">No</span>
                    @endif
                </td>
                <td>{{ $c->fiscal->rfc ?? '' }}</td>
                <td>{{ $c->fiscal->razon_social ?? '' }}</td>
                <td>{{ $c->fiscal->usoCfdi->clave ?? '' }}</td>
                <td>
                    @if($c->credito && $c->credito->tiene_linea)
                        <span class="badge badge-success">{{ number_format($c->credito->limite_credito,2) }}</span>
                    @else
                        <span class="badge badge-default">N/A</span>
                    @endif
                </td>
                <td class="text-center">{{ $c->credito->dias_credito ?? '' }}</td>
                <td class="text-center">{{ $c->fecha_alta ? \Carbon\Carbon::parse($c->fecha_alta)->format('d/m/Y') : '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
