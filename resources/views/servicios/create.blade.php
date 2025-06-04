@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nueva Orden de Servicio</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> Corrige los siguientes campos:<br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('servicios.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="folio" class="form-label">Folio</label>
                <input type="text" name="folio" id="folio" class="form-control" value="{{ old('folio') }}" required>
            </div>
            <div class="col-md-4">
                <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                <select name="tipo_cliente" id="tipo_cliente" class="form-select" required>
                    <option value="">Selecciona...</option>
                    <option value="Normal" @if(old('tipo_cliente')=='Normal') selected @endif>Normal</option>
                    <option value="Empresa" @if(old('tipo_cliente')=='Empresa') selected @endif>Empresa</option>
                    <option value="Otro" @if(old('tipo_cliente')=='Otro') selected @endif>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="imei" class="form-label">IMEI</label>
                <input type="text" name="imei" id="imei" class="form-control" value="{{ old('imei') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') ?? date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <label for="estado_id" class="form-label">Estado de la Orden</label>
                <select name="estado_id" id="estado_id" class="form-select" required>
                    <option value="">Selecciona...</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" @if(old('estado_id') == $estado->id) selected @endif>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}">
            </div>
        </div>

        <hr>
        <h5 class="mb-3">Diagnóstico (opcional)</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="problema" class="form-label">Detalle del Problema</label>
                <textarea name="problema" id="problema" class="form-control" rows="2">{{ old('problema') }}</textarea>
            </div>
            <div class="col-md-4">
                <label for="solucion" class="form-label">Solución</label>
                <textarea name="solucion" id="solucion" class="form-control" rows="2">{{ old('solucion') }}</textarea>
            </div>
            <div class="col-md-4">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control" rows="2">{{ old('observaciones') }}</textarea>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Guardar Orden
            </button>
        </div>
    </form>
</div>
@endsection
