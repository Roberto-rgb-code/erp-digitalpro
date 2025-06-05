@extends('layouts.app')
@section('page_title', 'Editar Proyecto de Cableado')

@section('content')
<div class="container">
    <h2>Editar Proyecto de Cableado</h2>
    <form action="{{ route('cableado.update', $proyecto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- igual que en create, pero cada input con value="{{ old('campo', $proyecto->campo) }}" -->
        <div class="mb-3">
            <label>Nombre del Proyecto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $proyecto->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label>Cliente Asociado</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}" {{ $proyecto->cliente_id == $c->id ? 'selected' : '' }}>{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipo de Proyecto</label>
            <select name="tipo_proyecto_id" class="form-control" required>
                @foreach($tipos as $t)
                    <option value="{{ $t->id }}" {{ $proyecto->tipo_proyecto_id == $t->id ? 'selected' : '' }}>{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proyecto->direccion) }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $proyecto->fecha_fin) }}" required>
        </div>
        <div class="mb-3">
            <label>Responsable</label>
            <select name="responsable_id" class="form-control" required>
                @foreach($empleados as $e)
                    <option value="{{ $e->id }}" {{ $proyecto->responsable_id == $e->id ? 'selected' : '' }}>{{ $e->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="Planeado" {{ $proyecto->estado == 'Planeado' ? 'selected' : '' }}>Planeado</option>
                <option value="En curso" {{ $proyecto->estado == 'En curso' ? 'selected' : '' }}>En curso</option>
                <option value="Finalizado" {{ $proyecto->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
            </select>
        </div>
        <button class="btn btn-success" type="submit">Guardar Cambios</button>
    </form>
</div>
@endsection
