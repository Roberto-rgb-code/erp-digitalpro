<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolizaServicio;
use App\Models\TicketSoporte;
use App\Models\InventarioCliente;
use App\Models\UsuarioCliente;
use App\Models\ConfiguracionCliente;
use App\Models\InformeServicio;

class ServiciosEmpresarialesController extends Controller
{
    public function index()
    {
        // Pólizas
        $polizas = PolizaServicio::with('cliente')->orderBy('fecha_inicio', 'desc')->paginate(10);

        // Tickets de soporte
        $tickets = TicketSoporte::with('poliza.cliente')->latest()->paginate(10);

        // Inventario de equipos
        $inventarios = InventarioCliente::with('poliza.cliente')->latest()->paginate(10);

        // Usuarios y credenciales
        $usuarios = UsuarioCliente::with('poliza.cliente')->latest()->paginate(10);

        // Configuraciones técnicas
        $configuraciones = ConfiguracionCliente::with('poliza.cliente')->latest()->paginate(10);

        // Reportes (Informe de Servicios)
        $reportes = InformeServicio::with('poliza.cliente')->latest()->paginate(10);

        // Totales para las tarjetas resumen
        $totalPolizas = $polizas->total();
        $totalTicketsAbiertos = TicketSoporte::where('estado', 'Pendiente')->count();
        $totalEquipos = $inventarios->total();
        $totalUsuarios = $usuarios->total();
        $totalConfig = $configuraciones->total();
        $totalReportes = $reportes->total();

        return view('servicios_empresariales.index', compact(
            'polizas',
            'tickets',
            'inventarios',
            'usuarios',
            'configuraciones',
            'reportes',
            'totalPolizas',
            'totalTicketsAbiertos',
            'totalEquipos',
            'totalUsuarios',
            'totalConfig',
            'totalReportes'
        ));
    }
}
