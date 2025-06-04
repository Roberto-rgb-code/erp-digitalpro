@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Editar Equipo</h4>
    <form action="{{ route('inventario_clientes.update', $equipo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Póliza asociada:</label>
            <select name="poliza_servicio_id" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach($polizas as $poliza)
                    <option value="{{ $poliza->id }}" {{ $equipo->poliza_servicio_id == $poliza->id ? 'selected' : '' }}>
                        {{ $poliza->id }} - {{ $poliza->cliente->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nombre del equipo:</label>
            <input type="text" name="nombre_equipo" class="form-control" value="{{ old('nombre_equipo', $equipo->nombre_equipo) }}" required>
        </div>
        <div class="mb-3">
            <label>Tipo de equipo:</label>
            <input type="text" name="tipo_equipo" class="form-control" value="{{ old('tipo_equipo', $equipo->tipo_equipo) }}" required>
        </div>
        <div class="mb-3">
            <label>Marca:</label>
            <input type="text" name="marca" class="form-control" value="{{ old('marca', $equipo->marca) }}">
        </div>
        <div class="mb-3">
            <label>Modelo:</label>
            <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $equipo->modelo) }}">
        </div>
        <div class="mb-3">
            <label>Número de serie:</label>
            <input type="text" name="numero_serie" class="form-control" value="{{ old('numero_serie', $equipo->numero_serie) }}">
        </div>
        <div class="mb-3">
            <label>IP:</label>
            <input type="text" name="ip" class="form-control" value="{{ old('ip', $equipo->ip) }}">
        </div>
        <div class="mb-3">
            <label>Observaciones:</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $equipo->observaciones) }}</textarea>
        </div>
        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
