<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PolizaServicioController;
use App\Http\Controllers\ServiciosEmpresarialesController;
use App\Http\Controllers\TicketSoporteController;
use App\Http\Controllers\InformeServicioController;
use App\Http\Controllers\ProyectoInstalacionController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\VehiculoController;





// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Proteger el home con auth middleware
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::resource('servicios', ServicioController::class);
Route::get('servicios/{id}/pdf', [App\Http\Controllers\ServicioController::class, 'pdf'])->name('servicios.pdf');
Route::resource('clientes', App\Http\Controllers\ClienteController::class);
Route::resource('ventas', 'App\Http\Controllers\VentaController');
Route::resource('polizas', PolizaServicioController::class);
Route::get('servicios_empresariales', [ServiciosEmpresarialesController::class, 'index'])->name('servicios_empresariales.index');
Route::resource('ticket_soportes', TicketSoporteController::class);
Route::resource('inventario_clientes', InventarioClienteController::class)->except(['show']);
Route::resource('usuario_clientes', UsuarioClienteController::class)->except(['show']);
Route::resource('configuracion_clientes', ConfiguracionClienteController::class)->except(['show']);
Route::resource('informe_servicios', InformeServicioController::class)->except(['show']);
Route::get('informe_servicios/{id}/pdf', [InformeServicioController::class, 'pdf'])->name('informe_servicios.pdf');
Route::resource('proyectos_software', App\Http\Controllers\ProyectoSoftwareController::class);
Route::resource('proyectos-instalacion', App\Http\Controllers\ProyectoInstalacionController::class);
Route::get('cableado', [ProyectoInstalacionController::class, 'index'])->name('cableado.index');
Route::resource('cableado', ProyectoInstalacionController::class);
Route::middleware(['auth'])->group(function() {
    Route::get('/administracion', [AdministracionController::class, 'index'])->name('administracion.index');
    // Si deseas, puedes definir submódulos:
    // Route::resource('gastos', GastoGeneralController::class);
    // Route::resource('ingresos', IngresoAdicionalController::class);
    // Route::resource('cortecaja', CorteCajaController::class);
    // Route::resource('indicadores', IndicadorController::class);
    // Y así con los demás submódulos...
});
Route::resource('gastos', GastoGeneralController::class);
Route::resource('vehiculos', VehiculoController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
});
// routes/web.php
Route::resource('empleados', EmpleadoController::class);
Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);
// Rutas para Cobranza (Cuentas por Cobrar)
Route::resource('cobranza', App\Http\Controllers\CobranzaController::class);
