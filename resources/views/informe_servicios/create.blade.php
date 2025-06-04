@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Nuevo Reporte por Cliente / Póliza</h4>
    <form action="{{ route('informe_servicios.store') }}" method="POST">
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
            <label>Servicios remotos consumidos:</label>
            <input type="number" name="servicios_remoto_consumidos" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label>Servicios a domicilio consumidos:</label>
            <input type="number" name="servicios_domicilio_consumidos" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label>Servicios remotos contratados:</label>
            <input type="number" name="servicios_remoto_contratados" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label>Servicios a domicilio contratados:</label>
            <input type="number" name="servicios_domicilio_contratados" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label>Fecha de corte:</label>
            <input type="date" name="fecha_corte" class="form-control">
        </div>
        <div class="mb-3">
            <label>Detalle:</label>
            <textarea name="detalle" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
