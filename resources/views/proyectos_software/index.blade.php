@extends('layouts.app')
@section('page_title', 'Proyectos de Software')

@section('content')
<div class="container">
    <h2 class="mb-4">Proyectos de Software</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <canvas id="graficaEstados"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="graficaTipos"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="graficaPromedios"></canvas>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Inicio</th>
                <th>Entrega</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $p)
                <tr>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->cliente->nombre ?? '-' }}</td>
                    <td>{{ $p->tipo->nombre ?? '-' }}</td>
                    <td>{{ $p->responsable->nombre ?? '-' }}</td>
                    <td>{{ $p->estado }}</td>
                    <td>{{ $p->fecha_inicio }}</td>
                    <td>{{ $p->fecha_entrega }}</td>
                    <td>
                        <a href="{{ route('proyectos_software.show', $p->id) }}" class="btn btn-info btn-sm">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $proyectos->links() }}
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfica de Estados
    new Chart(document.getElementById('graficaEstados').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: @json($estados),
            datasets: [{
                data: @json($conteosEstados),
                backgroundColor: ['#6c63ff', '#4b9cff', '#6ee7b7', '#ffe066']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } },
            title: { display: true, text: 'Estados de proyectos' }
        }
    });

    // Gráfica de Tipos de Proyecto
    new Chart(document.getElementById('graficaTipos').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($tipos),
            datasets: [{
                label: 'Proyectos por tipo',
                data: @json($conteosTipos),
                backgroundColor: '#4b9cff'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            title: { display: true, text: 'Proyectos por tipo' },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Gráfica de Avance Promedio por Proyecto
    new Chart(document.getElementById('graficaPromedios').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($proyectos->pluck('nombre')),
            datasets: [{
                label: 'Avance promedio (%)',
                data: @json($promediosAvance),
                fill: false,
                borderColor: '#6c63ff',
                tension: 0.2
            }]
        },
        options: {
            plugins: { legend: { display: true } },
            title: { display: true, text: 'Avance promedio de módulos' },
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });
</script>
@endpush
@endsection
