<?php

namespace App\Http\Controllers;

use App\Models\InformeServicio;
use App\Models\PolizaServicio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InformeServicioController extends Controller
{
    public function index()
    {
        $reportes = InformeServicio::with('poliza.cliente')->latest()->paginate(10);
        return view('informe_servicios.index', compact('reportes'));
    }

    public function create()
    {
        $polizas = PolizaServicio::with('cliente')->get();
        return view('informe_servicios.create', compact('polizas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'servicios_remoto_consumidos' => 'required|integer|min:0',
            'servicios_domicilio_consumidos' => 'required|integer|min:0',
            'servicios_remoto_contratados' => 'required|integer|min:0',
            'servicios_domicilio_contratados' => 'required|integer|min:0',
            'fecha_corte' => 'nullable|date',
            'detalle' => 'nullable|string',
        ]);

        InformeServicio::create($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Reporte generado correctamente.');
    }

    public function edit($id)
    {
        $reporte = InformeServicio::findOrFail($id);
        $polizas = PolizaServicio::with('cliente')->get();
        return view('informe_servicios.edit', compact('reporte', 'polizas'));
    }

    public function update(Request $request, $id)
    {
        $reporte = InformeServicio::findOrFail($id);
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'servicios_remoto_consumidos' => 'required|integer|min:0',
            'servicios_domicilio_consumidos' => 'required|integer|min:0',
            'servicios_remoto_contratados' => 'required|integer|min:0',
            'servicios_domicilio_contratados' => 'required|integer|min:0',
            'fecha_corte' => 'nullable|date',
            'detalle' => 'nullable|string',
        ]);
        $reporte->update($request->all());
        return redirect()->route('servicios_empresariales.index')->with('success', 'Reporte actualizado correctamente.');
    }

    public function destroy($id)
    {
        $reporte = InformeServicio::findOrFail($id);
        $reporte->delete();
        return redirect()->route('servicios_empresariales.index')->with('success', 'Reporte eliminado correctamente.');
    }

    public function pdf($id)
    {
        $reporte = InformeServicio::with('poliza.cliente')->findOrFail($id);
        $pdf = Pdf::loadView('informe_servicios.pdf', compact('reporte'));
        return $pdf->download('reporte_poliza_'.$reporte->poliza_servicio_id.'.pdf');
    }
}
