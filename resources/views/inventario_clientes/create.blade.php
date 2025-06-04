@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Registrar Nuevo Equipo</h4>
    <form action="{{ route('inventario_clientes.store') }}" method="POST">
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
            <label>Nombre del equipo:</label>
            <input type="text" name="nombre_equipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipo de equipo:</label>
            <input type="text" name="tipo_equipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Marca:</label>
            <input type="text" name="marca" class="form-control">
        </div>
        <div class="mb-3">
            <label>Modelo:</label>
            <input type="text" name="modelo" class="form-control">
        </div>
        <div class="mb-3">
            <label>Número de serie:</label>
            <input type="text" name="numero_serie" class="form-control">
        </div>
        <div class="mb-3">
            <label>IP:</label>
            <input type="text" name="ip" class="form-control">
        </div>
        <div class="mb-3">
            <label>Observaciones:</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
