@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Registrar Nueva Configuración Técnica</h4>
    <form action="{{ route('configuracion_clientes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Póliza asociada:</label>
            <select name="poliza_servicio_id" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach($polizas as $poliza)
                    <option value="{{ $poliza->id }}">
                        {{ $poliza->id }} - {{ $poliza->cliente->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipo de red:</label>
            <input type="text" name="tipo_red" class="form-control">
        </div>
        <div class="mb-3">
            <label>IP pública:</label>
            <input type="text" name="ip_publica" class="form-control">
        </div>
        <div class="mb-3">
            <label>IP privada:</label>
            <input type="text" name="ip_privada" class="form-control">
        </div>
        <div class="mb-3">
            <label>Gateway:</label>
            <input type="text" name="gateway" class="form-control">
        </div>
        <div class="mb-3">
            <label>DNS:</label>
            <input type="text" name="dns" class="form-control">
        </div>
        <div class="mb-3">
            <label>Software instalado:</label>
            <input type="text" name="software_instalado" class="form-control">
        </div>
        <div class="mb-3">
            <label>Accesos:</label>
            <textarea name="accesos" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Notas:</label>
            <textarea name="notas" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
