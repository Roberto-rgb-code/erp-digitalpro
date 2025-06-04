@extends('layouts.app')

@section('page_title', 'Servicios Empresariales')

@section('content')
<div class="container">
    <h2 class="mb-4">Servicios Empresariales</h2>

    {{-- DASHBOARD DE ESTADÍSTICAS GENERALES --}}
    <div class="row mb-4 g-3">
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Pólizas activas<br><span class="fw-bold fs-3">{{ $totalPolizas }}</span></div></div></div>
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Tickets abiertos<br><span class="fw-bold fs-3">{{ $totalTicketsAbiertos }}</span></div></div></div>
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Equipos registrados<br><span class="fw-bold fs-3">{{ $totalEquipos }}</span></div></div></div>
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Usuarios<br><span class="fw-bold fs-3">{{ $totalUsuarios }}</span></div></div></div>
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Configuraciones<br><span class="fw-bold fs-3">{{ $totalConfig }}</span></div></div></div>
        <div class="col-md-2"><div class="card card-summary text-center"><div class="card-body">Reportes<br><span class="fw-bold fs-3">{{ $totalReportes }}</span></div></div></div>
    </div>

    {{-- TABS DE SUBMÓDULOS --}}
    <ul class="nav nav-tabs mb-3" id="empresarialTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="polizas-tab" data-bs-toggle="tab" data-bs-target="#polizas" type="button" role="tab">Pólizas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets" type="button" role="tab">Tickets</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="inventario-tab" data-bs-toggle="tab" data-bs-target="#inventario" type="button" role="tab">Inventario</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab">Usuarios</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="config-tab" data-bs-toggle="tab" data-bs-target="#config" type="button" role="tab">Configuraciones</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reportes-tab" data-bs-toggle="tab" data-bs-target="#reportes" type="button" role="tab">Reportes</button>
        </li>
    </ul>
    <div class="tab-content" id="empresarialTabsContent">
        <div class="tab-pane fade show active" id="polizas" role="tabpanel">
            @include('servicios_empresariales.partials.polizas')
        </div>
        <div class="tab-pane fade" id="tickets" role="tabpanel">
            @include('servicios_empresariales.partials.tickets')
        </div>
        <div class="tab-pane fade" id="inventario" role="tabpanel">
            @include('servicios_empresariales.partials.inventario')
        </div>        
        <div class="tab-pane fade" id="usuarios" role="tabpanel">
            @include('servicios_empresariales.partials.usuarios')
        </div>        
        <div class="tab-pane fade" id="config" role="tabpanel">
            @include('servicios_empresariales.partials.configuraciones')
        </div>        
        <div class="tab-pane fade" id="reportes" role="tabpanel">
            @include('servicios_empresariales.partials.reportes')
        </div>        
    </div>
</div>
@endsection
