<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Usuarios y credenciales</h5>
    <a href="{{ route('usuario_clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo Usuario
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
                <th>Nombre</th>
                <th>Rol</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($usuarios as $user)
            <tr>
                <td>{{ $user->poliza->id ?? '-' }}</td>
                <td>{{ $user->poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $user->nombre_usuario }}</td>
                <td>{{ $user->rol }}</td>
                <td>{{ $user->usuario_acceso }}</td>
                <td>{{ $user->password_acceso }}</td>
                <td>{{ $user->observaciones }}</td>
                <td>
                    <a href="{{ route('usuario_clientes.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('usuario_clientes.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">No hay usuarios registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $usuarios->links() }}
</div>
