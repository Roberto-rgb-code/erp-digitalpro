<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>ERP SRDigitalPro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f5f6fa; }
        .sidebar {
            min-width: 240px;
            max-width: 240px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #eee;
        }
        .sidebar .nav-link.active {
            background: #eaeaff;
            color: #6c63ff !important;
            font-weight: 600;
        }
        .sidebar .nav-link {
            color: #555;
            transition: .2s;
        }
        .sidebar .nav-link:hover {
            background: #f3f3fd;
            color: #6c63ff !important;
        }
        .user-info {
            background: #f3f3fd;
            border-radius: 10px;
            padding: 12px;
        }
        .main-content {
            min-height: 100vh;
            background: #f5f6fa;
        }
        .card-summary {
            border-radius: 12px;
            box-shadow: 0 4px 24px #bdbdf04a;
        }
        .dashboard-title {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3 shadow-sm">
        <a href="{{ route('home') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
            <i class="bi bi-stack fs-3 me-2 text-primary"></i>
            <span class="fs-4 fw-bold">ERP SRDigitalPro</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link @if(request()->routeIs('home')) active @endif">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Clientes
                </a>
            </li>
            <li>
                <a href="{{ route('ventas.index') }}" class="nav-link {{ request()->is('ventas*') ? 'active' : '' }}">
                    <i class="bi bi-bag me-2"></i> Ventas
                </a>
            </li>
            <li>
                <a href="{{ route('servicios.index') }}" class="nav-link {{ request()->is('servicios*') ? 'active' : '' }}">
                    <i class="bi bi-tools me-2"></i> Servicios
                </a>
            </li>
            <li>
                <a href="{{ route('servicios_empresariales.index') }}" class="nav-link {{ request()->is('servicios_empresariales*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase me-2"></i> Servicios Empresariales
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos_software.index') }}" class="nav-link {{ request()->is('proyectos_software*') ? 'active' : '' }}">
                    <i class="bi bi-laptop"></i> Desarrollo de Software
                </a>
            </li>            
            <li>
                <a href="{{ route('cableado.index') }}" class="nav-link {{ request()->is('cableado*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3 me-2"></i> Cableado Estructurado
                </a>
            </li>            
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-currency-dollar me-2"></i> Cobranza
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-shield-check me-2"></i> Administración
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-truck me-2"></i> Control de Vehículos
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-people-fill me-2"></i> Recursos Humanos
                </a>
            </li>
        </ul>
        <hr>
        <div class="user-info d-flex align-items-center gap-2">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Usuario" class="rounded-circle" width="36">
            <div>
                <div class="fw-bold">Admin</div>
                <small class="text-muted">admin@erp.com</small>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Navbar superior -->
        <nav class="navbar navbar-light bg-white px-4 shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h4">
                    @yield('page_title', 'Dashboard')
                </span>
                <div>
                    <button class="btn btn-light me-2"><i class="bi bi-arrow-repeat"></i> Actualizar</button>
                    <button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo Reporte</button>
                </div>
            </div>
        </nav>
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')
</body>
</html>
