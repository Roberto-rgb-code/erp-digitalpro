@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Orden de Servicio</h2>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-3">Folio</dt>
                <dd class="col-md-9">{{ $orden->folio }}</dd>

                <dt class="col-md-3">Tipo de Cliente</dt>
                <dd class="col-md-9">{{ $orden->tipo_cliente }}</dd>

                <dt class="col-md-3">IMEI</dt>
                <dd class="col-md-9">{{ $orden->imei }}</dd>

                <dt class="col-md-3">Fecha de Ingreso</dt>
                <dd class="col-md-9">{{ $orden->fecha_ingreso }}</dd>

                <dt class="col-md-3">Estado</dt>
                <dd class="col-md-9">
                    <span class="badge bg-primary">{{ $orden->estado->nombre }}</span>
                </dd>

                <dt class="col-md-3">Descripción</dt>
                <dd class="col-md-9">{{ $orden->descripcion }}</dd>
            </dl>
        </div>
    </div>

    @if($diagnostico)
    <div class="card mb-4">
        <div class="card-header">Diagnóstico</div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-3">Problema</dt>
                <dd class="col-md-9">{{ $diagnostico->problema }}</dd>

                <dt class="col-md-3">Solución</dt>
                <dd class="col-md-9">{{ $diagnostico->solucion }}</dd>

                <dt class="col-md-3">Observaciones</dt>
                <dd class="col-md-9">{{ $diagnostico->observaciones }}</dd>
            </dl>
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
        <div>
            <a href="{{ route('servicios.edit', $orden->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('servicios.pdf', $orden->id) }}" class="btn btn-outline-dark" target="_blank">
                <i class="bi bi-printer"></i> Imprimir / PDF
            </a>
        </div>
    </div>
    
</div>
@endsection
