@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ficha de Cliente</h2>
    <div class="mb-3">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Datos Generales</div>
        <div class="card-body row g-3">
            <div class="col-md-6"><strong>Folio:</strong> <span class="badge bg-dark">{{ $cliente->folio }}</span></div>
            <div class="col-md-6"><strong>Nombre:</strong> {{ $cliente->nombre }}</div>
            <div class="col-md-6"><strong>Tipo:</strong> {{ $cliente->tipo->nombre ?? '' }}</div>
            <div class="col-md-4"><strong>Teléfono:</strong> {{ $cliente->telefono }}</div>
            <div class="col-md-4"><strong>Email:</strong> {{ $cliente->email }}</div>
            <div class="col-md-4"><strong>Fecha de alta:</strong> {{ $cliente->fecha_alta ? \Carbon\Carbon::parse($cliente->fecha_alta)->format('d/m/Y') : '' }}</div>
            <div class="col-md-3"><strong>Factura:</strong>
                @if($cliente->requiere_factura)
                    <span class="badge bg-success">Sí</span>
                @else
                    <span class="badge bg-secondary">No</span>
                @endif
            </div>
        </div>
    </div>

    @if($cliente->fiscal)
    <div class="card mb-3">
        <div class="card-header bg-info text-white">Datos Fiscales</div>
        <div class="card-body row g-3">
            <div class="col-md-4"><strong>RFC:</strong> {{ $cliente->fiscal->rfc }}</div>
            <div class="col-md-6"><strong>Razón Social:</strong> {{ $cliente->fiscal->razon_social }}</div>
            <div class="col-md-4"><strong>Uso CFDI:</strong> {{ $cliente->fiscal->uso_cfdi }}</div>
            <div class="col-md-8"><strong>Dirección Fiscal:</strong> {{ $cliente->fiscal->direccion_fiscal }}</div>
        </div>
    </div>
    @endif

    @if($cliente->credito && $cliente->credito->tiene_linea)
    <div class="card mb-3">
        <div class="card-header bg-warning">Datos de Crédito</div>
        <div class="card-body row g-3">
            <div class="col-md-4"><strong>Límite de crédito:</strong> ${{ number_format($cliente->credito->limite_credito,2) }}</div>
            <div class="col-md-4"><strong>Días de crédito:</strong> {{ $cliente->credito->dias_credito }}</div>
        </div>
    </div>
    @endif

    @if($cliente->documentos->count())
    <div class="card mb-3">
        <div class="card-header bg-light">Documentos</div>
        <div class="card-body row g-3">
            @foreach($cliente->documentos as $doc)
                <div class="col-md-4 mb-2">
                    <strong>{{ ucfirst($doc->tipo_doc) }}:</strong>
                    <a href="{{ asset('storage/'.$doc->archivo) }}" target="_blank" class="btn btn-outline-primary btn-sm ms-2">
                        Descargar
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
