@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- DASHBOARD DE VENTAS --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">Ventas por Estado</div>
                <div class="card-body">
                    <div id="ventas_por_estado" style="min-height:180px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">Ventas por Mes</div>
                <div class="card-body">
                    <div id="ventas_por_mes" style="min-height:180px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">Total Vendido (Últimos 6 meses)</div>
                <div class="card-body">
                    <div id="ventas_total_mes" style="min-height:180px"></div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-2">
            <input type="text" name="folio" class="form-control" placeholder="Buscar folio..." value="{{ request('folio') }}">
        </div>
        <div class="col-md-3">
            <select name="cliente_id" class="form-select">
                <option value="">Todos los clientes</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} ({{ $cliente->folio }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="estado_id" class="form-select">
                <option value="">Todos los estados</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                        {{ $estado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_venta" class="form-control" value="{{ request('fecha_venta') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Buscar</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <div class="mb-3 text-end">
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Venta
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Facturado</th>
                    <th>Pagado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td><span class="badge bg-dark">{{ $venta->folio }}</span></td>
                    <td>{{ $venta->cliente->nombre ?? '-' }} <span class="badge bg-light text-dark">{{ $venta->cliente->folio ?? '' }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                    <td>${{ number_format($venta->total,2) }}</td>
                    <td><span class="badge bg-info">{{ $venta->estado->nombre ?? '-' }}</span></td>
                    <td>
                        @if($venta->facturado)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        @if($venta->pagado)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-sm btn-info" title="Ver"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay ventas registradas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $ventas->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
const estados = @json($estadosNombres);
const ventasPorEstado = @json($ventasPorEstado);
const meses = @json($meses);
const ventasPorMes = @json($ventasPorMes);
const totalesPorMes = @json($totalesPorMes);

// Gráfica 1: Barras por estado
new ApexCharts(document.querySelector("#ventas_por_estado"), {
    chart: { type: 'bar', height: 180 },
    series: [{ name: 'Ventas', data: ventasPorEstado }],
    xaxis: { categories: estados }
}).render();

// Gráfica 2: Línea por cantidad de ventas
new ApexCharts(document.querySelector("#ventas_por_mes"), {
    chart: { type: 'line', height: 180 },
    series: [{ name: 'Ventas', data: ventasPorMes }],
    xaxis: { categories: meses }
}).render();

// Gráfica 3: Área por total vendido
new ApexCharts(document.querySelector("#ventas_total_mes"), {
    chart: { type: 'area', height: 180 },
    series: [{ name: 'Total ($)', data: totalesPorMes }],
    xaxis: { categories: meses }
}).render();
</script>
@endpush
