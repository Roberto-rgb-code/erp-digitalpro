@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Ticket</h2>
    <div class="mb-3">
        <a href="{{ route('servicios_empresariales.index') }}#tickets" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Datos del Ticket</div>
        <div class="card-body row g-3">
            <div class="col-md-4"><strong>Folio:</strong> {{ $ticket->folio }}</div>
            <div class="col-md-4"><strong>Póliza:</strong> {{ $ticket->poliza->id ?? '-' }}</div>
            <div class="col-md-4"><strong>Cliente:</strong> {{ $ticket->poliza->cliente->nombre ?? '-' }}</div>
            <div class="col-md-4"><strong>Título:</strong> {{ $ticket->titulo }}</div>
            <div class="col-md-4"><strong>Prioridad:</strong> <span class="badge bg-info">{{ $ticket->prioridad }}</span></div>
            <div class="col-md-4"><strong>Estado:</strong>
                @if($ticket->estado === 'Pendiente')
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @elseif($ticket->estado === 'En proceso')
                    <span class="badge bg-primary">En proceso</span>
                @elseif($ticket->estado === 'Resuelto')
                    <span class="badge bg-success">Resuelto</span>
                @else
                    <span class="badge bg-secondary">Cerrado</span>
                @endif
            </div>
            <div class="col-md-12"><strong>Descripción:</strong><br>{{ $ticket->descripcion }}</div>
            <div class="col-md-4"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</div>
@endsection
