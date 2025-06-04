@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Editar Configuración Técnica</h4>
    <form action="{{ route('configuracion_clientes.update', $configuracion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Póliza asociada:</label>
            <select name="poliza_servicio_id" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach($polizas as $poliza)
                    <option value="{{ $poliza->id }}" {{ $configuracion->poliza_servicio_id == $poliza->id ? 'selected' : '' }}>
                        {{ $poliza->id }} - {{ $poliza->cliente->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipo de red:</label>
            <input type="text" name="tipo_red" class="form-control" value="{{ old('tipo_red', $configuracion->tipo_red) }}">
        </div>
        <div class="mb-3">
            <label>IP pública:</label>
            <input type="text" name="ip_publica" class="form-control" value="{{ old('ip_publica', $configuracion->ip_publica) }}">
        </div>
        <div class="mb-3">
            <label>IP privada:</label>
            <input type="text" name="ip_privada" class="form-control" value="{{ old('ip_privada', $configuracion->ip_privada) }}">
        </div>
        <div class="mb-3">
            <label>Gateway:</label>
            <input type="text" name="gateway" class="form-control" value="{{ old('gateway', $configuracion->gateway) }}">
        </div>
        <div class="mb-3">
            <label>DNS:</label>
            <input type="text" name="dns" class="form-control" value="{{ old('dns', $configuracion->dns) }}">
        </div>
        <div class="mb-3">
            <label>Software instalado:</label>
            <input type="text" name="software_instalado" class="form-control" value="{{ old('software_instalado', $configuracion->software_instalado) }}">
        </div>
        <div class="mb-3">
            <label>Accesos:</label>
            <textarea name="accesos" class="form-control">{{ old('accesos', $configuracion->accesos) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Notas:</label>
            <textarea name="notas" class="form-control">{{ old('notas', $configuracion->notas) }}</textarea>
        </div>
        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
