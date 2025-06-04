<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Configuraciones Técnicas</h5>
    <a href="{{ route('configuracion_clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva Configuración
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
                <th>Tipo Red</th>
                <th>IP Pública</th>
                <th>IP Privada</th>
                <th>Gateway</th>
                <th>DNS</th>
                <th>Software</th>
                <th>Accesos</th>
                <th>Notas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($configuraciones as $config)
            <tr>
                <td>{{ $config->poliza->id ?? '-' }}</td>
                <td>{{ $config->poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $config->tipo_red }}</td>
                <td>{{ $config->ip_publica }}</td>
                <td>{{ $config->ip_privada }}</td>
                <td>{{ $config->gateway }}</td>
                <td>{{ $config->dns }}</td>
                <td>{{ $config->software_instalado }}</td>
                <td>{{ $config->accesos }}</td>
                <td>{{ $config->notas }}</td>
                <td>
                    <a href="{{ route('configuracion_clientes.edit', $config->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('configuracion_clientes.destroy', $config->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar configuración?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="11" class="text-center">No hay configuraciones registradas.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $configuraciones->links() }}
</div>
