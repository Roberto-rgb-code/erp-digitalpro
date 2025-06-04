@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Clientes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- GRAFICAS --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">Clientes por tipo</div>
                <div class="card-body"><div id="clientes_por_tipo" style="min-height:180px"></div></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">¿Requiere factura?</div>
                <div class="card-body"><div id="clientes_factura" style="min-height:180px"></div></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header fw-bold">Altas por mes</div>
                <div class="card-body"><div id="clientes_altas_mes" style="min-height:180px"></div></div>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..." value="{{ request('nombre') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="folio" class="form-control" placeholder="Buscar por folio..." value="{{ request('folio') }}">
        </div>
        <div class="col-md-3">
            <select name="tipo_cliente_id" class="form-select">
                <option value="">Todos los tipos</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ request('tipo_cliente_id') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="requiere_factura" class="form-select">
                <option value="">¿Requiere factura?</option>
                <option value="1" {{ request('requiere_factura') == "1" ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('requiere_factura') == "0" ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Buscar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <div class="mb-3 text-end">
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Cliente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Factura</th>
                    <th>Crédito</th>
                    <th>Alta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>
                        <span class="badge bg-dark">{{ $cliente->folio }}</span>
                    </td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}">{{ $cliente->nombre }}</a>
                    </td>
                    <td>{{ $cliente->tipo->nombre ?? '' }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        @if($cliente->requiere_factura)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        @if($cliente->credito && $cliente->credito->tiene_linea)
                            <span class="badge bg-primary">Límite: ${{ number_format($cliente->credito->limite_credito, 2) }}</span>
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </td>
                    <td>{{ $cliente->fecha_alta ? \Carbon\Carbon::parse($cliente->fecha_alta)->format('d/m/Y') : '' }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info" title="Ver"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No hay clientes registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $clientes->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
const tipos = @json($tiposNombres);
const clientesPorTipo = @json($clientesPorTipo);
const requiere = @json($requiere);
const noRequiere = @json($noRequiere);
const meses = @json($meses);
const altasPorMes = @json($altasPorMes);

// Gráfica 1: Barras por tipo
new ApexCharts(document.querySelector("#clientes_por_tipo"), {
    chart: { type: 'bar', height: 180 },
    series: [{ name: 'Clientes', data: clientesPorTipo }],
    xaxis: { categories: tipos }
}).render();

// Gráfica 2: Pastel requiere factura
new ApexCharts(document.querySelector("#clientes_factura"), {
    chart: { type: 'pie', height: 180 },
    series: [requiere, noRequiere],
    labels: ['Requiere factura', 'No requiere'],
    colors: ['#2ecc40', '#ff4136']
}).render();

// Gráfica 3: Línea altas por mes
new ApexCharts(document.querySelector("#clientes_altas_mes"), {
    chart: { type: 'line', height: 180 },
    series: [{ name: 'Altas', data: altasPorMes }],
    xaxis: { categories: meses }
}).render();
</script>
@endpush
