@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($ticket) ? 'Editar Ticket' : 'Nuevo Ticket de Soporte' }}</h2>

    <form action="{{ isset($ticket) ? route('ticket_soportes.update', $ticket->id) : route('ticket_soportes.store') }}" method="POST">
        @csrf
        @if(isset($ticket)) @method('PUT') @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="poliza_servicio_id" class="form-label">Póliza</label>
                <select name="poliza_servicio_id" id="poliza_servicio_id" class="form-select" required>
                    <option value="">Selecciona...</option>
                    @foreach($polizas as $poliza)
                        <option value="{{ $poliza->id }}"
                            {{ old('poliza_servicio_id', $ticket->poliza_servicio_id ?? '') == $poliza->id ? 'selected' : '' }}>
                            {{ $poliza->id }} - {{ $poliza->cliente->nombre ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="prioridad" class="form-label">Prioridad</label>
                <select name="prioridad" id="prioridad" class="form-select" required>
                    @foreach(['Baja','Normal','Alta'] as $p)
                        <option value="{{ $p }}"
                            {{ old('prioridad', $ticket->prioridad ?? 'Normal') == $p ? 'selected' : '' }}>
                            {{ $p }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    @foreach(['Pendiente','En proceso','Resuelto','Cerrado'] as $e)
                        <option value="{{ $e }}"
                            {{ old('estado', $ticket->estado ?? 'Pendiente') == $e ? 'selected' : '' }}>
                            {{ $e }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control"
                   value="{{ old('titulo', $ticket->titulo ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required>{{ old('descripcion', $ticket->descripcion ?? '') }}</textarea>
        </div>

        <div class="mb-3 text-end">
            <a href="{{ route('servicios_empresariales.index') }}#tickets" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">{{ isset($ticket) ? 'Actualizar' : 'Guardar' }}</button>
        </div>
    </form>
</div>
@endsection
