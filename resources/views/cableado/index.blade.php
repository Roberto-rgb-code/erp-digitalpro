@extends('layouts.app')

@section('page_title', 'Cableado Estructurado')

@section('content')
<div class="container">
    <h2 class="mb-4">Cableado Estructurado</h2>
    
    {{-- Tarjetas resumen --}}
    <div class="row mb-4 g-3">
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Proyectos<br><span class="fw-bold fs-3">{{ $totalProyectos }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">En Curso<br><span class="fw-bold fs-3">{{ $proyectosActivos }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Finalizados<br><span class="fw-bold fs-3">{{ $proyectosFinalizados }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Materiales Asignados<br><span class="fw-bold fs-3">{{ $materialesTotales }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Avance Promedio<br><span class="fw-bold fs-3">{{ number_format($avancePromedio, 1) }}%</span></div></div></div>
    </div>

    {{-- Gráfica de tipos de proyecto --}}
    <div class="card mb-4">
        <div class="card-body">
            <canvas id="chartTipos"></canvas>
        </div>
    </div>
    
    {{-- Botón nuevo proyecto --}}
    <div class="mb-3 text-end">
        <a href="{{ route('cableado.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo Proyecto</a>
    </div>
    
    {{-- Tabla de proyectos --}}
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Inicio</th>
                        <th>Avance</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyectos as $proy)
                        <tr>
                            <td>{{ $proy->nombre }}</td>
                            <td>{{ $proy->cliente->nombre ?? '-' }}</td>
                            <td>{{ $proy->tipoProyecto->nombre ?? '-' }}</td>
                            <td>{{ $proy->estado }}</td>
                            <td>{{ $proy->responsable->nombre ?? '-' }}</td>
                            <td>{{ $proy->fecha_inicio }}</td>
                            <td>
                                <div class="progress" style="height: 18px;">
                                    <div class="progress-bar bg-success" style="width: {{ $proy->avance ?? 0 }}%">
                                        {{ $proy->avance ?? 0 }}%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('cableado.show', $proy->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('cableado.edit', $proy->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">Sin proyectos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $proyectos->links() }}
        </div>
    </div>
</div>

{{-- Chart.js script --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chartTipos').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($tipos->pluck('nombre')),
            datasets: [{
                label: 'Proyectos por tipo',
                data: @json($tipos->pluck('proyectos_count')),
                backgroundColor: 'rgba(52, 144, 220, 0.7)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>
@endpush

@endsection
