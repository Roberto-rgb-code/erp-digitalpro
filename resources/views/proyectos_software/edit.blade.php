@extends('layouts.app')
@section('page_title', 'Editar Proyecto de Software')

@section('content')
<div class="container">
    <h2>Editar Proyecto de Software</h2>
    <form action="{{ route('proyectos_software.update', $proyecto->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label>Nombre del proyecto *</label>
                <input type="text" name="nombre" class="form-control" required value="{{ old('nombre', $proyecto->nombre) }}">
            </div>
            <div class="col-md-6">
                <label>Cliente asociado *</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Selecciona cliente...</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id }}" {{ old('cliente_id', $proyecto->cliente_id) == $c->id ? 'selected' : '' }}>{{ $c->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Tipo de proyecto *</label>
                <select name="tipo_software_id" class="form-select" required>
                    <option value="">Selecciona tipo...</option>
                    @foreach($tipos as $t)
                        <option value="{{ $t->id }}" {{ old('tipo_software_id', $proyecto->tipo_software_id) == $t->id ? 'selected' : '' }}>{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Responsable del proyecto</label>
                <select name="responsable_id" class="form-select">
                    <option value="">Sin asignar</option>
                    @foreach($empleados as $e)
                        <option value="{{ $e->id }}" {{ old('responsable_id', $proyecto->responsable_id) == $e->id ? 'selected' : '' }}>{{ $e->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Estado del proyecto *</label>
                <select name="estado" class="form-select" required>
                    <option value="Planeado" {{ $proyecto->estado == "Planeado" ? 'selected' : '' }}>Planeado</option>
                    <option value="En desarrollo" {{ $proyecto->estado == "En desarrollo" ? 'selected' : '' }}>En desarrollo</option>
                    <option value="Testing" {{ $proyecto->estado == "Testing" ? 'selected' : '' }}>Testing</option>
                    <option value="Finalizado" {{ $proyecto->estado == "Finalizado" ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Fecha de inicio *</label>
                <input type="date" name="fecha_inicio" class="form-control" required value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}">
            </div>
            <div class="col-md-4">
                <label>Fecha de entrega</label>
                <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega', $proyecto->fecha_entrega) }}">
            </div>
            <div class="col-md-4">
                <label>Stack tecnológico</label>
                <input type="text" name="stack" class="form-control" value="{{ old('stack', $proyecto->stack) }}" placeholder="Ej: Python, React, SQL">
            </div>
            <div class="col-12">
                <label>Historial del proyecto (opcional)</label>
                <textarea name="historial" class="form-control">{{ old('historial', $proyecto->historial) }}</textarea>
            </div>
            <div class="col-12 text-end">
                <a href="{{ route('proyectos_software.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar proyecto</button>
            </div>
        </div>
    </form>
</div>
@endsection
