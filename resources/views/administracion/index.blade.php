@extends('layouts.app')

@section('page_title', 'Panel de Administración')

@section('content')
<div class="container">
    <h2 class="mb-4">Panel de Administración</h2>

    {{-- DASHBOARD DE KPIs --}}
    <div class="row mb-4 g-3">
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Total Gastos<br><span class="fw-bold fs-3">${{ number_format($totalGastos,2) }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Total Ingresos<br><span class="fw-bold fs-3">${{ number_format($totalIngresos,2) }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Por Cobrar<br><span class="fw-bold fs-3">${{ number_format($cuentasPorCobrar,2) }}</span></div></div></div>
        <div class="col"><div class="card card-summary text-center"><div class="card-body">Por Pagar<br><span class="fw-bold fs-3">${{ number_format($cuentasPorPagar,2) }}</span></div></div></div>
    </div>

    {{-- CORTE DE CAJA Y PROYECCIÓN --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Último Corte de Caja</div>
                <div class="card-body">
                    @if($ultimoCorte)
                        Fecha: {{ $ultimoCorte->fecha }} <br>
                        Ingresos: <b>${{ number_format($ultimoCorte->ingresos,2) }}</b><br>
                        Egresos: <b>${{ number_format($ultimoCorte->egresos,2) }}</b><br>
                        Total: <b>${{ number_format($ultimoCorte->total,2) }}</b><br>
                        <small>{{ $ultimoCorte->notas }}</small>
                    @else
                        <span class="text-muted">No hay cortes registrados.</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Proyección Financiera</div>
                <div class="card-body">
                    @if($proyeccion)
                        Fecha: {{ $proyeccion->fecha }} <br>
                        Estimado: <b>${{ number_format($proyeccion->estimado_flujo,2) }}</b><br>
                        <small>{{ $proyeccion->notas }}</small>
                    @else
                        <span class="text-muted">No hay proyecciones registradas.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- RENTABILIDAD --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Rentabilidad reciente</div>
        <div class="card-body">
            @if($rentabilidad)
                Línea: {{ $rentabilidad->linea_negocio ?? 'General' }}<br>
                Ingresos: <b>${{ number_format($rentabilidad->ingresos,2) }}</b> /
                Egresos: <b>${{ number_format($rentabilidad->egresos,2) }}</b> /
                Utilidad neta: <b>${{ number_format($rentabilidad->utilidad_neta,2) }}</b>
            @else
                <span class="text-muted">Sin información</span>
            @endif
        </div>
    </div>

    {{-- INDICADORES --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Indicadores clave</div>
        <div class="card-body">
            @if($indicadores->count())
                <ul>
                    @foreach($indicadores as $kpi)
                        <li><b>{{ $kpi->nombre }}:</b> {{ number_format($kpi->valor,2) }} <span class="text-muted">{{ $kpi->descripcion }}</span></li>
                    @endforeach
                </ul>
            @else
                <span class="text-muted">No hay KPIs definidos.</span>
            @endif
        </div>
    </div>

    {{-- ACCESOS RÁPIDOS --}}
    <div class="row mb-4">
        <div class="col"><a href="{{ url('gastos') }}" class="btn btn-outline-primary w-100">Gastos</a></div>
        <div class="col"><a href="{{ url('ingresos') }}" class="btn btn-outline-primary w-100">Ingresos</a></div>
        <div class="col"><a href="{{ url('cortecaja') }}" class="btn btn-outline-primary w-100">Corte de Caja</a></div>
        <div class="col"><a href="{{ url('indicadores') }}" class="btn btn-outline-primary w-100">KPIs</a></div>
        <div class="col"><a href="{{ url('rentabilidad') }}" class="btn btn-outline-primary w-100">Rentabilidad</a></div>
        <div class="col"><a href="{{ url('documentosfinancieros') }}" class="btn btn-outline-primary w-100">Documentos</a></div>
    </div>
</div>
@endsection
