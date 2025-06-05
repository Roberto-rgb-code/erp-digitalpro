<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoGeneral;
use App\Models\CategoriaGasto;
use App\Models\IngresoAdicional;
use App\Models\CorteCaja;
use App\Models\CuentaPorCobrar;
use App\Models\CuentaPorPagar;
use App\Models\ProyeccionFinanciera;
use App\Models\Rentabilidad;
use App\Models\Indicador;
use App\Models\DocumentosFinancieros;
use App\Models\BitacoraAdministrativa;

class AdministracionController extends Controller
{
    public function index()
    {
        // Totales para dashboard
        $totalGastos = GastoGeneral::sum('monto');
        $totalIngresos = IngresoAdicional::sum('monto');
        $cuentasPorCobrar = CuentaPorCobrar::where('estado', 'Pendiente')->sum('monto');
        $cuentasPorPagar = CuentaPorPagar::where('estado', 'Pendiente')->sum('monto');
        $ultimoCorte = CorteCaja::latest('fecha')->first();
        $proyeccion = ProyeccionFinanciera::orderByDesc('fecha')->first();
        $rentabilidad = Rentabilidad::orderByDesc('fecha')->first();
        $indicadores = Indicador::orderByDesc('fecha')->take(5)->get();

        return view('administracion.index', compact(
            'totalGastos','totalIngresos','cuentasPorCobrar','cuentasPorPagar',
            'ultimoCorte','proyeccion','rentabilidad','indicadores'
        ));
    }

    // Puedes agregar métodos index, create, store, edit, update, destroy por cada sub-módulo...
}
