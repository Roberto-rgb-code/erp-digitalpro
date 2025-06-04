<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Inventario de Equipos</h5>
    <a href="{{ route('inventario_clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo Equipo
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
                <th>Equipo</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>IP</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($inventarios as $inv)
            <tr>
                <td>{{ $inv->poliza->id ?? '-' }}</td>
                <td>{{ $inv->poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $inv->nombre_equipo }}</td>
                <td>{{ $inv->tipo_equipo }}</td>
                <td>{{ $inv->marca }}</td>
                <td>{{ $inv->modelo }}</td>
                <td>{{ $inv->numero_serie }}</td>
                <td>{{ $inv->ip }}</td>
                <td>
                    <a href="{{ route('inventario_clientes.edit', $inv->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('inventario_clientes.destroy', $inv->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar equipo?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">No hay equipos registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $inventarios->links() }}
</div>
