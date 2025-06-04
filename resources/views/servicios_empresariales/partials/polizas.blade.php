<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Pólizas activas</h5>
    <a href="{{ route('polizas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva Póliza
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Remotos</th>
                <th>Domicilio</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Activa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($polizas as $poliza)
            <tr>
                <td>{{ $poliza->id }}</td>
                <td>{{ $poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $poliza->tipo_poliza }}</td>
                <td>{{ $poliza->servicios_restantes_remoto }}</td>
                <td>{{ $poliza->servicios_restantes_domicilio }}</td>
                <td>{{ \Carbon\Carbon::parse($poliza->fecha_inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($poliza->fecha_fin)->format('d/m/Y') }}</td>
                <td>
                    @if($poliza->activa)
                        <span class="badge bg-success">Sí</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('polizas.show', $poliza->id) }}" class="btn btn-sm btn-info" title="Ver"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('polizas.edit', $poliza->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('polizas.destroy', $poliza->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar póliza?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">No hay pólizas registradas.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $polizas->links() }}
</div>
