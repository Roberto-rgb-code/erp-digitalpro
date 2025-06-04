@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detalle de Póliza de Servicio</h4>
    <div class="mb-3">
        <a href="{{ route('servicios_empresariales.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <a href="{{ route('polizas.edit', $poliza->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
    </div>
    <div class="card mb-3">
        <div class="card-body row g-3">
            <div class="col-md-6"><strong>Cliente:</strong> {{ $poliza->cliente->nombre ?? '-' }}</div>
            <div class="col-md-6"><strong>Tipo de póliza:</strong> {{ $poliza->tipo_poliza }}</div>
            <div class="col-md-6"><strong>Servicios remotos restantes:</strong> {{ $poliza->servicios_restantes_remoto }}</div>
            <div class="col-md-6"><strong>Servicios a domicilio restantes:</strong> {{ $poliza->servicios_restantes_domicilio }}</div>
            <div class="col-md-6"><strong>Fecha de inicio:</strong> {{ \Carbon\Carbon::parse($poliza->fecha_inicio)->format('d/m/Y') }}</div>
            <div class="col-md-6"><strong>Fecha de fin:</strong> {{ \Carbon\Carbon::parse($poliza->fecha_fin)->format('d/m/Y') }}</div>
            <div class="col-md-6"><strong>¿Activa?</strong>
                @if($poliza->activa)
                    <span class="badge bg-success">Sí</span>
                @else
                    <span class="badge bg-secondary">No</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
