@extends('layouts.app')
@section('page_title', 'Detalle del Proyecto de Cableado')

@section('content')
<div class="container">
    <h2>Detalle del Proyecto de Cableado</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $proyecto->nombre }}</h5>
            <p><strong>Cliente:</strong> {{ $proyecto->cliente->nombre ?? '-' }}</p>
            <p><strong>Tipo:</strong> {{ $proyecto->tipoProyecto->nombre ?? '-' }}</p>
            <p><strong>Dirección:</strong> {{ $proyecto->direccion }}</p>
            <p><strong>Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
            <p><strong>Fin:</strong> {{ $proyecto->fecha_fin }}</p>
            <p><strong>Responsable:</strong> {{ $proyecto->responsable->nombre ?? '-' }}</p>
            <p><strong>Estado:</strong> {{ $proyecto->estado }}</p>
        </div>
    </div>
    <a href="{{ route('cableado.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
