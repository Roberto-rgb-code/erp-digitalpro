@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold mb-0">Clientes</h2>
        <div>
            <a href="{{ route('clientes.export.excel') }}" class="btn btn-success me-1">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
            <a href="{{ route('clientes.export.pdf') }}" class="btn btn-danger me-1">
                <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nuevo Cliente
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- FILTROS AVANZADOS --}}
    <form method="GET" class="row g-3 mb-4 align-items-end">
        <div class="col-md-2">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre / Empresa..." value="{{ request('nombre') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="folio" class="form-control" placeholder="Folio..." value="{{ request('folio') }}">
        </div>
        <div class="col-md-2">
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
            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ request('telefono') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="email" class="form-control" placeholder="Correo" value="{{ request('email') }}">
        </div>
        <div class="col-md-2">
            <select name="requiere_factura" class="form-select">
                <option value="">¿Requiere factura?</option>
                <option value="1" {{ request('requiere_factura') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('requiere_factura') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="rfc" class="form-control" placeholder="RFC" value="{{ request('rfc') }}">
        </div>
        <div class="col-md-2">
            <select name="uso_cfdi_id" class="form-select">
                <option value="">Uso CFDI</option>
                @isset($usosCfdi)
                    @foreach($usosCfdi as $uso)
                        <option value="{{ $uso->id }}" {{ request('uso_cfdi_id') == $uso->id ? 'selected' : '' }}>
                            {{ $uso->clave }} - {{ $uso->descripcion }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_alta_inicio" class="form-control" value="{{ request('fecha_alta_inicio') }}" placeholder="Fecha alta desde">
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_alta_fin" class="form-control" value="{{ request('fecha_alta_fin') }}" placeholder="Fecha alta hasta">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i> Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg"></i> Limpiar</a>
        </div>
    </form>

    {{-- GRÁFICAS --}}
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Clientes por tipo</div>
                <div class="card-body">
                    <canvas id="chartTipos" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-bold">¿Requiere factura?</div>
                <div class="card-body">
                    <canvas id="chartFactura" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Altas por mes</div>
                <div class="card-body">
                    <canvas id="chartAltas" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
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
                        <th>Alta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td><span class="badge bg-dark">{{ $cliente->folio }}</span></td>
                        <td>
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="text-primary fw-bold">{{ $cliente->nombre }}</a>
                        </td>
                        <td>{{ $cliente->tipo->nombre ?? '' }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            @if($cliente->configuracion && $cliente->configuracion->requiere_factura)
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $cliente->fiscal->rfc ?? '' }}</td>
                        <td>{{ $cliente->fiscal->razon_social ?? '' }}</td>
                        <td>{{ $cliente->fiscal?->usoCfdi?->clave ?? '' }}</td>
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
                        <td colspan="13" class="text-center text-muted">No hay clientes registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos desde el controlador
    const tiposNombres = @json($tipos->pluck('nombre'));
    const clientesPorTipo = @json($tipos->map(fn($tipo) => $tipo->clientes()->count()));
    const requiere = @json(\App\Models\ClienteConfiguracion::where('requiere_factura', true)->count());
    const noRequiere = @json(\App\Models\ClienteConfiguracion::where('requiere_factura', false)->count());
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    const altasPorMes = @json(
        collect(range(1,12))->map(
            fn($m) => \App\Models\Cliente::whereMonth('fecha_alta', $m)->count()
        )
    );

    // Colores para gráficos
    const pastel = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#f8f9fc', '#5a5c69'
    ];

    // Clientes por tipo
    new Chart(document.getElementById('chartTipos').getContext('2d'), {
        type: 'bar',
        data: {
            labels: tiposNombres,
            datasets: [{
                label: 'Clientes',
                data: clientesPorTipo,
                backgroundColor: pastel,
                borderRadius: 10,
            }]
        },
        options: {
            plugins: { legend: { display: false }},
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }} }
        }
    });

    // Requiere factura Pie
    new Chart(document.getElementById('chartFactura').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Requiere factura', 'No requiere'],
            datasets: [{
                data: [requiere, noRequiere],
                backgroundColor: [pastel[1], pastel[4]],
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });

    // Altas por mes
    new Chart(document.getElementById('chartAltas').getContext('2d'), {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Altas',
                data: altasPorMes,
                fill: true,
                borderColor: pastel[0],
                backgroundColor: pastel[0]+'33',
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: pastel[0],
            }]
        },
        options: {
            plugins: { legend: { display: false }},
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
