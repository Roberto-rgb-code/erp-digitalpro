@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Registrar Nuevo Usuario</h4>
    <form action="{{ route('usuario_clientes.store') }}" method="POST">
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
            <label>Nombre de usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rol:</label>
            <input type="text" name="rol" class="form-control">
        </div>
        <div class="mb-3">
            <label>Usuario de acceso:</label>
            <input type="text" name="usuario_acceso" class="form-control">
        </div>
        <div class="mb-3">
            <label>Contraseña de acceso:</label>
            <input type="text" name="password_acceso" class="form-control">
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
