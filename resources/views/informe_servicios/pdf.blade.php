<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicio</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; }
        h2 { text-align: center; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #666; padding: 4px; }
    </style>
</head>
<body>
    <h2>Reporte de Servicio</h2>
    <p><b>Póliza:</b> {{ $reporte->poliza->id ?? '-' }}</p>
    <p><b>Cliente:</b> {{ $reporte->poliza->cliente->nombre ?? '-' }}</p>
    <p><b>Servicios remotos consumidos:</b> {{ $reporte->servicios_remoto_consumidos }}</p>
    <p><b>Servicios a domicilio consumidos:</b> {{ $reporte->servicios_domicilio_consumidos }}</p>
    <p><b>Servicios remotos contratados:</b> {{ $reporte->servicios_remoto_contratados }}</p>
    <p><b>Servicios a domicilio contratados:</b> {{ $reporte->servicios_domicilio_contratados }}</p>
    <p><b>Fecha de corte:</b> {{ $reporte->fecha_corte }}</p>
    <p><b>Detalle:</b> <br>{{ $reporte->detalle }}</p>
</body>
</html>
