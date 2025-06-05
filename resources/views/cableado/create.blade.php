@extends('layouts.app')
@section('page_title', 'Nuevo Proyecto de Cableado')

@section('content')
<div class="container">
    <h2>Registrar Nuevo Proyecto de Cableado</h2>
    <form action="{{ route('cableado.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre del Proyecto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Cliente Asociado</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipo de Proyecto</label>
            <select name="tipo_proyecto_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($tipos as $t)
                    <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Responsable</label>
            <select name="responsable_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($empleados as $e)
                    <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="Planeado">Planeado</option>
                <option value="En curso">En curso</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <button class="btn btn-success" type="submit">Registrar</button>
    </form>
</div>
@endsection
