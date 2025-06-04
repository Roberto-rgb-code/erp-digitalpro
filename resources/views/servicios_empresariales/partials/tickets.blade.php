<div class="d-flex justify-content-between mb-3">
    <h5 class="dashboard-title">Tickets de soporte</h5>
    <a href="{{ route('ticket_soportes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo Ticket
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Folio</th>
                <th>Póliza</th>
                <th>Cliente</th>
                <th>Título</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->folio }}</td>
                <td>{{ $ticket->poliza->id ?? '-' }}</td>
                <td>{{ $ticket->poliza->cliente->nombre ?? '-' }}</td>
                <td>{{ $ticket->titulo }}</td>
                <td>
                    <span class="badge bg-info">{{ $ticket->prioridad }}</span>
                </td>
                <td>
                    @if($ticket->estado === 'Pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @elseif($ticket->estado === 'En proceso')
                        <span class="badge bg-primary">En proceso</span>
                    @elseif($ticket->estado === 'Resuelto')
                        <span class="badge bg-success">Resuelto</span>
                    @else
                        <span class="badge bg-secondary">Cerrado</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('ticket_soportes.show', $ticket->id) }}" class="btn btn-sm btn-info" title="Ver"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('ticket_soportes.edit', $ticket->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('ticket_soportes.destroy', $ticket->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar ticket?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">No hay tickets registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div>
    {{ $tickets->links() }}
</div>
