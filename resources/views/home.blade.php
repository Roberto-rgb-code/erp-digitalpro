@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-summary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span>Ventas Totales</span>
                    <i class="bi bi-graph-up-arrow fs-3 text-primary"></i>
                </div>
                <h3 class="dashboard-title">$24,780</h3>
                <span class="text-success small">+12.5% respecto al mes anterior</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-summary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span>Valor de Inventario</span>
                    <i class="bi bi-box-seam fs-3 text-success"></i>
                </div>
                <h3 class="dashboard-title">$187,420</h3>
                <span class="text-success small">+3.2% respecto al mes anterior</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-summary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span>Órdenes Abiertas</span>
                    <i class="bi bi-cart3 fs-3 text-warning"></i>
                </div>
                <h3 class="dashboard-title">34</h3>
                <span class="text-danger small">-8.1% respecto al mes anterior</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-summary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span>Gastos</span>
                    <i class="bi bi-credit-card-2-front fs-3 text-danger"></i>
                </div>
                <h3 class="dashboard-title">$12,480</h3>
                <span class="text-danger small">+5.4% respecto al mes anterior</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Resumen de Ventas -->
    <div class="col-md-6 mb-4">
        <div class="card card-summary h-100">
            <div class="card-header bg-white border-0">
                Resumen de Ventas
                <a href="#" class="float-end small text-primary">Ver Detalles</a>
            </div>
            <div class="card-body">
                <!-- Puedes reemplazar este SVG por una gráfica real con Chart.js -->
                <svg height="100" width="100%" class="w-100">
                    <polyline fill="#eaeaff" stroke="#6c63ff" stroke-width="3"
                        points="0,100 10,90 20,80 30,65 40,75 50,55 60,60 70,40 80,45 90,30 100,10 110,15 120,5 130,10 140,2 150,0" />
                </svg>
            </div>
        </div>
    </div>
    <!-- Estado de Inventario -->
    <div class="col-md-6 mb-4">
        <div class="card card-summary h-100">
            <div class="card-header bg-white border-0">
                Estado de Inventario
                <a href="#" class="float-end small text-primary">Ver Detalles</a>
            </div>
            <div class="card-body">
                <!-- Puedes reemplazar por gráfico real con Chart.js -->
                <div class="d-flex justify-content-between mb-2">
                    <div>
                        <div class="fw-bold text-primary">En Stock</div>
                        <div class="text-muted small">Electrónica: 120</div>
                        <div class="text-muted small">Muebles: 80</div>
                        <div class="text-muted small">Oficina: 150</div>
                    </div>
                    <div>
                        <div class="fw-bold text-warning">Punto de Reorden</div>
                        <div class="text-muted small">Cocina: 60</div>
                        <div class="text-muted small">Ropa: 70</div>
                    </div>
                </div>
                <svg height="100" width="100%" class="w-100">
                    <rect x="5" y="40" width="25" height="60" fill="#6c63ff" />
                    <rect x="35" y="80" width="25" height="20" fill="#ffc107" />
                    <rect x="65" y="50" width="25" height="50" fill="#6c63ff" />
                    <rect x="95" y="90" width="25" height="10" fill="#ffc107" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
