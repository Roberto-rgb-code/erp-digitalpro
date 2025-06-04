@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Órdenes de Servicio</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Visualización rápida con ApexCharts --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Órdenes por Estado (Barras)</div>
                <div class="card-body">
                    <div id="apex_barras" style="min-height: 240px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Órdenes por Día (últimos 10 días)</div>
                <div class="card-body">
                    <div id="apex_linea" style="min-height: 240px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros avanzados --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="estado_id" class="form-label">Estado</label>
            <select name="estado_id" id="estado_id" class="form-select">
                <option value="">Todos</option>
                @foreach(\App\Models\EstadoOrdenServicio::all() as $estado)
                    <option value="{{ $estado->id }}" @if(request('estado_id') == $estado->id) selected @endif>
                        {{ $estado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="folio" class="form-label">Folio</label>
            <input type="text" name="folio" id="folio" class="form-control" value="{{ request('folio') }}">
        </div>
        <div class="col-md-2">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" value="{{ request('cliente') }}">
        </div>
        <div class="col-md-2">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ request('fecha_ingreso') }}">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Buscar</button>
            <a href="{{ route('servicios.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <div class="mb-3 text-end">
        <a href="{{ route('servicios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Orden de Servicio
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Folio</th>
                    <th>Tipo Cliente</th>
                    <th>IMEI</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ $servicio->folio }}</td>
                    <td>{{ $servicio->tipo_cliente }}</td>
                    <td>{{ $servicio->imei }}</td>
                    <td>{{ $servicio->fecha_ingreso }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $servicio->estado->nombre }}</span>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($servicio->descripcion, 40) }}</td>
                    <td>
                        <a href="{{ route('servicios.show', $servicio->id) }}" class="btn btn-sm btn-info" title="Ver"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta orden?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay órdenes de servicio registradas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $servicios->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // --- Traer datos desde PHP ---
    const estados = @json($estadisticas->pluck('estado')->toArray());
    const totales = @json($estadisticas->pluck('total')->toArray());
    const fechas = @json($fechas);
    const dias = @json(array_values($dias->toArray()));

    // Gráfica de Barras por Estado
    if(estados.length && totales.length) {
        var optionsBar = {
            chart: { type: 'bar', height: 240 },
            series: [{ name: 'Órdenes', data: totales }],
            xaxis: { categories: estados },
            colors: ['#3a86ff'],
            dataLabels: { enabled: true }
        };
        var chartBar = new ApexCharts(document.querySelector("#apex_barras"), optionsBar);
        chartBar.render();
    } else {
        document.getElementById('apex_barras').innerHTML = 'Sin datos para graficar';
    }

    // Gráfica de Línea por Día
    if(fechas.length && dias.length) {
        var optionsLine = {
            chart: { type: 'line', height: 240 },
            series: [{ name: 'Órdenes', data: dias }],
            xaxis: { categories: fechas },
            colors: ['#fb5607'],
            dataLabels: { enabled: true }
        };
        var chartLine = new ApexCharts(document.querySelector("#apex_linea"), optionsLine);
        chartLine.render();
    } else {
        document.getElementById('apex_linea').innerHTML = 'Sin datos para graficar';
    }
});
</script>
@endpush
