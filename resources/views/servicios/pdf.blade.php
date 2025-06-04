<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Orden de Servicio PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #222; }
        .header { border-bottom: 1px solid #ccc; margin-bottom: 18px; }
        .header img { height: 40px; }
        .titulo { font-size: 20px; font-weight: bold; margin-top: 10px; }
        .seccion { margin-bottom: 18px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 6px; border: 1px solid #eee; }
        .label { background: #f5f5f5; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    {{-- Logo empresa, cámbialo por el tuyo --}}
                    <img src="https://dummyimage.com/120x40/6c63ff/fff&text=SRDigitalPro" alt="Logo">
                </td>
                <td style="text-align:right">
                    <span class="titulo">Orden de Servicio</span><br>
                    <small>Folio: <strong>{{ $orden->folio }}</strong></small>
                </td>
            </tr>
        </table>
    </div>
    <div class="seccion">
        <table>
            <tr>
                <td class="label">Tipo de Cliente</td>
                <td>{{ $orden->tipo_cliente }}</td>
                <td class="label">IMEI</td>
                <td>{{ $orden->imei }}</td>
            </tr>
            <tr>
                <td class="label">Fecha de Ingreso</td>
                <td>{{ $orden->fecha_ingreso }}</td>
                <td class="label">Estado</td>
                <td>{{ $orden->estado->nombre }}</td>
            </tr>
            <tr>
                <td class="label">Descripción</td>
                <td colspan="3">{{ $orden->descripcion }}</td>
            </tr>
        </table>
    </div>

    @if($diagnostico)
    <div class="seccion">
        <table>
            <tr>
                <th colspan="4" style="background:#eaeaff;">Diagnóstico Técnico</th>
            </tr>
            <tr>
                <td class="label">Problema</td>
                <td colspan="3">{{ $diagnostico->problema }}</td>
            </tr>
            <tr>
                <td class="label">Solución</td>
                <td colspan="3">{{ $diagnostico->solucion }}</td>
            </tr>
            <tr>
                <td class="label">Observaciones</td>
                <td colspan="3">{{ $diagnostico->observaciones }}</td>
            </tr>
        </table>
    </div>
    @endif

    <div class="seccion" style="margin-top: 35px;">
        <table>
            <tr>
                <td style="height: 45px; width: 50%; text-align: center;">
                    _______________________________<br>
                    Firma del cliente
                </td>
                <td style="height: 45px; width: 50%; text-align: center;">
                    _______________________________<br>
                    Firma del técnico
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
