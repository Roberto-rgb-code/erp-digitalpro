@extends('layouts.app')
@section('page_title', 'Detalle del Proyecto de Software')

@section('content')
<div class="container">
    <h2>Detalle del Proyecto</h2>
    <div class="card p-4 mb-4">
        <dl class="row">
            <dt class="col-sm-3">Nombre:</dt>
            <dd class="col-sm-9">{{ $proyecto->nombre }}</dd>

            <dt class="col-sm-3">Cliente:</dt>
            <dd class="col-sm-9">{{ $proyecto->cliente->nombre ?? '-' }}</dd>

            <dt class="col-sm-3">Tipo:</dt>
            <dd class="col-sm-9">{{ $proyecto->tipo->nombre ?? '-' }}</dd>

            <dt class="col-sm-3">Stack:</dt>
            <dd class="col-sm-9">{{ $proyecto->stack }}</dd>

            <dt class="col-sm-3">Responsable:</dt>
            <dd class="col-sm-9">{{ $proyecto->responsable->nombre ?? '-' }}</dd>

            <dt class="col-sm-3">Estado:</dt>
            <dd class="col-sm-9">{{ $proyecto->estado }}</dd>

            <dt class="col-sm-3">Fecha inicio:</dt>
            <dd class="col-sm-9">{{ $proyecto->fecha_inicio }}</dd>

            <dt class="col-sm-3">Fecha entrega:</dt>
            <dd class="col-sm-9">{{ $proyecto->fecha_entrega }}</dd>

            <dt class="col-sm-3">Historial:</dt>
            <dd class="col-sm-9">{{ $proyecto->historial }}</dd>
        </dl>
        <a href="{{ route('proyectos_software.edit', $proyecto->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('proyectos_software.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    <h4>Módulos del sistema</h4>
    <ul>
        @foreach($proyecto->modulos as $modulo)
            <li>
                <strong>{{ $modulo->nombre }}</strong> ({{ $modulo->avance }}%) - {{ $modulo->fase }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
