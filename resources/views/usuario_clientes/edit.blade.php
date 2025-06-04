@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Editar Usuario</h4>
    <form action="{{ route('usuario_clientes.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Póliza asociada:</label>
            <select name="poliza_servicio_id" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach($polizas as $poliza)
                    <option value="{{ $poliza->id }}" {{ $usuario->poliza_servicio_id == $poliza->id ? 'selected' : '' }}>
                        {{ $poliza->id }} - {{ $poliza->cliente->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nombre de usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}" required>
        </div>
        <div class="mb-3">
            <label>Rol:</label>
            <input type="text" name="rol" class="form-control" value="{{ old('rol', $usuario->rol) }}">
        </div>
        <div class="mb-3">
            <label>Usuario de acceso:</label>
            <input type="text" name="usuario_acceso" class="form-control" value="{{ old('usuario_acceso', $usuario->usuario_acceso) }}">
        </div>
        <div class="mb-3">
            <label>Contraseña de acceso:</label>
            <input type="text" name="password_acceso" class="form-control" value="{{ old('password_acceso', $usuario->password_acceso) }}">
        </div>
        <div class="mb-3">
            <label>Observaciones:</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $usuario->observaciones) }}</textarea>
        </div>
        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
