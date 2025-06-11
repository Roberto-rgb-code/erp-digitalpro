<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PolizaServicioController;
use App\Http\Controllers\ServiciosEmpresarialesController;
use App\Http\Controllers\TicketSoporteController;
use App\Http\Controllers\InformeServicioController;
use App\Http\Controllers\ProyectoInstalacionController;
use App\Http\Controllers\ProyectoSoftwareController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GastoGeneralController;
use App\Http\Controllers\CobranzaController;

// --- Autenticación ---
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// --- Home protegido por auth ---
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// --- Módulo Clientes ---
Route::resource('clientes', ClienteController::class);

// Rutas de exportación y reporte (implementa la lógica después)
Route::get('clientes-export-excel', [ClienteController::class, 'exportExcel'])->name('clientes.export.excel');
Route::get('clientes-export-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.export.pdf');
Route::get('clientes-reporte', [ClienteController::class, 'reporte'])->name('clientes.reporte');

// --- Módulo Ventas ---
Route::resource('ventas', VentaController::class);

// --- Módulo Servicios ---
Route::resource('servicios', ServicioController::class);
Route::get('servicios/{id}/pdf', [ServicioController::class, 'pdf'])->name('servicios.pdf');

// --- Módulo Polizas y Servicios Empresariales ---
Route::resource('polizas', PolizaServicioController::class);
Route::get('servicios_empresariales', [ServiciosEmpresarialesController::class, 'index'])->name('servicios_empresariales.index');
Route::resource('ticket_soportes', TicketSoporteController::class);
Route::resource('inventario_clientes', App\Http\Controllers\InventarioClienteController::class)->except(['show']);
Route::resource('usuario_clientes', App\Http\Controllers\UsuarioClienteController::class)->except(['show']);
Route::resource('configuracion_clientes', App\Http\Controllers\ConfiguracionClienteController::class)->except(['show']);
Route::resource('informe_servicios', InformeServicioController::class)->except(['show']);
Route::get('informe_servicios/{id}/pdf', [InformeServicioController::class, 'pdf'])->name('informe_servicios.pdf');

// --- Módulo Proyectos ---
Route::resource('proyectos_software', ProyectoSoftwareController::class);
Route::resource('proyectos-instalacion', ProyectoInstalacionController::class);
Route::get('cableado', [ProyectoInstalacionController::class, 'index'])->name('cableado.index');
Route::resource('cableado', ProyectoInstalacionController::class);

// --- Administración ---
Route::middleware(['auth'])->group(function() {
    Route::get('/administracion', [AdministracionController::class, 'index'])->name('administracion.index');
    Route::resource('gastos', GastoGeneralController::class);
    // Agrega aquí otros submódulos administrativos:
    // Route::resource('ingresos', IngresoAdicionalController::class);
    // Route::resource('cortecaja', CorteCajaController::class);
    // Route::resource('indicadores', IndicadorController::class);
});

// --- Vehículos ---
Route::resource('vehiculos', VehiculoController::class);

// --- Empleados ---
Route::resource('empleados', EmpleadoController::class);

// --- Cobranza (Cuentas por Cobrar) ---
Route::resource('cobranza', CobranzaController::class);
Route::get('clientes/export/excel', [ClienteController::class, 'exportExcel'])->name('clientes.export.excel');
Route::get('clientes/export/pdf', [ClienteController::class, 'exportPdf'])->name('clientes.export.pdf');

