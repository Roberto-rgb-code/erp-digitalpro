<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Reportes por Cliente / Póliza</h5>
    <a href="{{ route('informe_servicios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo Reporte
    </a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Póliza</th>
                <th>Cliente</th>
                <th>Servicios Remoto</th>
                <th>Servicios Domicilio</th>
                <th>Remoto Contratados</th>
                <th>Domicilio Contratados</th>
                <th>Fecha Corte</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($reportes as $rep)
            <tr>
                <td>{{ $rep->poliza->id ?? '-' }}</td>
                <td>{{ $rep->poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $rep->servicios_remoto_consumidos }}</td>
                <td>{{ $rep->servicios_domicilio_consumidos }}</td>
                <td>{{ $rep->servicios_remoto_contratados }}</td>
                <td>{{ $rep->servicios_domicilio_contratados }}</td>
                <td>{{ $rep->fecha_corte }}</td>
                <td>
                    <a href="{{ route('informe_servicios.edit', $rep->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <a href="{{ route('informe_servicios.pdf', $rep->id) }}" class="btn btn-sm btn-outline-dark" title="PDF" target="_blank"><i class="bi bi-printer"></i></a>
                    <form action="{{ route('informe_servicios.destroy', $rep->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar reporte?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">No hay reportes registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $reportes->links() }}
</div>
