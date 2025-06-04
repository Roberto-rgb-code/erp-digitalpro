@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Venta</h2>
    <div class="mb-3">
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Datos generales</div>
        <div class="card-body row g-3">
            <div class="col-md-4"><strong>Folio:</strong> <span class="badge bg-dark">{{ $venta->folio }}</span></div>
            <div class="col-md-4"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</div>
            <div class="col-md-4"><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? '-' }} ({{ $venta->cliente->folio ?? '' }})</div>
            <div class="col-md-4"><strong>Estado:</strong> <span class="badge bg-info">{{ $venta->estado->nombre ?? '' }}</span></div>
            <div class="col-md-4"><strong>Total:</strong> ${{ number_format($venta->total,2) }}</div>
            <div class="col-md-4"><strong>Facturado:</strong> {!! $venta->facturado ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>' !!}</div>
            <div class="col-md-4"><strong>Pagado:</strong> {!! $venta->pagado ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>' !!}</div>
            <div class="col-md-12"><strong>Observaciones:</strong> {{ $venta->observaciones }}</div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-light">Productos de la venta</div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Producto/Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($venta->productos as $prod)
                    <tr>
                        <td>{{ $prod->producto }}</td>
                        <td>{{ $prod->cantidad }}</td>
                        <td>${{ number_format($prod->precio_unitario,2) }}</td>
                        <td>${{ number_format($prod->subtotal,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
