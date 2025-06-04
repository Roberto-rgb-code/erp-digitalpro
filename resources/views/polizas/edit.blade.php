@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{ isset($poliza) ? 'Editar Póliza de Servicio' : 'Nueva Póliza de Servicio' }}</h4>

    <form action="{{ isset($poliza) ? route('polizas.update', $poliza->id) : route('polizas.store') }}" method="POST">
        @csrf
        @if(isset($poliza)) @method('PUT') @endif

        <div class="mb-3">
            <label>Cliente:</label>
            <select name="cliente_id" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('cliente_id', $poliza->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipo de póliza:</label>
            <input type="text" name="tipo_poliza" class="form-control"
                   value="{{ old('tipo_poliza', $poliza->tipo_poliza ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Servicios remotos incluidos:</label>
            <input type="number" name="servicios_restantes_remoto" class="form-control"
                   value="{{ old('servicios_restantes_remoto', $poliza->servicios_restantes_remoto ?? '') }}" min="0" required>
        </div>
        <div class="mb-3">
            <label>Servicios a domicilio incluidos:</label>
            <input type="number" name="servicios_restantes_domicilio" class="form-control"
                   value="{{ old('servicios_restantes_domicilio', $poliza->servicios_restantes_domicilio ?? '') }}" min="0" required>
        </div>
        <div class="mb-3">
            <label>Fecha de inicio:</label>
            <input type="date" name="fecha_inicio" class="form-control"
                   value="{{ old('fecha_inicio', isset($poliza) ? \Illuminate\Support\Carbon::parse($poliza->fecha_inicio)->format('Y-m-d') : '') }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha de fin:</label>
            <input type="date" name="fecha_fin" class="form-control"
                   value="{{ old('fecha_fin', isset($poliza) ? \Illuminate\Support\Carbon::parse($poliza->fecha_fin)->format('Y-m-d') : '') }}" required>
        </div>
        <div class="mb-3">
            <label>¿Póliza activa?</label>
            <select name="activa" class="form-select" required>
                <option value="1" {{ old('activa', $poliza->activa ?? 1) == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('activa', $poliza->activa ?? 1) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button class="btn btn-success">{{ isset($poliza) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
