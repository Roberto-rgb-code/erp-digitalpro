@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Proyecto de Instalación</h2>
    <form action="{{ route('proyectos-instalacion.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Nombre del Proyecto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($clientes as $c)
                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Tipo de Proyecto</label>
            <select name="tipo_proyecto_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($tipos as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Responsable</label>
            <select name="responsable_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($empleados as $e)
                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="Planeado">Planeado</option>
                <option value="En curso">En curso</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <button class="btn btn-success mt-2">Guardar</button>
    </form>
</div>
@endsection
