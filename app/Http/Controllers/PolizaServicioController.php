<?php

namespace App\Http\Controllers;

use App\Models\PolizaServicio;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PolizaServicioController extends Controller
{
    public function index()
    {
        $polizas = PolizaServicio::with('cliente')->orderBy('fecha_inicio', 'desc')->paginate(10);
        return view('polizas.index', compact('polizas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('polizas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_poliza' => 'required|string|max:100',
            'servicios_restantes_remoto' => 'required|integer|min:0',
            'servicios_restantes_domicilio' => 'required|integer|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activa' => 'nullable|boolean',
        ]);

        PolizaServicio::create([
            'cliente_id' => $request->cliente_id,
            'tipo_poliza' => $request->tipo_poliza,
            'servicios_restantes_remoto' => $request->servicios_restantes_remoto,
            'servicios_restantes_domicilio' => $request->servicios_restantes_domicilio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->activa ? true : false,
        ]);

        return redirect()->route('polizas.index')->with('success', 'Póliza registrada correctamente.');
    }

    public function show($id)
    {
        $poliza = PolizaServicio::with('cliente')->findOrFail($id);
        return view('polizas.show', compact('poliza'));
    }

    public function edit($id)
    {
        $poliza = PolizaServicio::findOrFail($id);
        $clientes = Cliente::all();
        return view('polizas.edit', compact('poliza', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $poliza = PolizaServicio::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_poliza' => 'required|string|max:100',
            'servicios_restantes_remoto' => 'required|integer|min:0',
            'servicios_restantes_domicilio' => 'required|integer|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activa' => 'nullable|boolean',
        ]);

        $poliza->update([
            'cliente_id' => $request->cliente_id,
            'tipo_poliza' => $request->tipo_poliza,
            'servicios_restantes_remoto' => $request->servicios_restantes_remoto,
            'servicios_restantes_domicilio' => $request->servicios_restantes_domicilio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->activa ? true : false,
        ]);

        return redirect()->route('polizas.index')->with('success', 'Póliza actualizada correctamente.');
    }

    public function destroy($id)
    {
        $poliza = PolizaServicio::findOrFail($id);
        $poliza->delete();
        return redirect()->route('polizas.index')->with('success', 'Póliza eliminada correctamente.');
    }
}
