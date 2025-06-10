@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="puesto_empleado_id" class="form-label">Puesto</label>
            <select name="puesto_empleado_id" id="puesto_empleado_id" class="form-select" required>
                <option value="">Selecciona un puesto</option>
                @foreach($puestos as $p)
                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
                <option value="Baja">Baja</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="notas_internas" class="form-label">Notas internas</label>
            <textarea name="notas_internas" id="notas_internas" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
