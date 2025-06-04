<?php

namespace App\Http\Controllers;

use App\Models\InventarioCliente;
use App\Models\PolizaServicio;
use Illuminate\Http\Request;

class InventarioClienteController extends Controller
{
    public function index()
    {
        $inventarios = InventarioCliente::with('poliza.cliente')->latest()->paginate(10);
        return view('inventario_clientes.index', compact('inventarios'));
    }

    public function create()
    {
        $polizas = PolizaServicio::with('cliente')->get();
        return view('inventario_clientes.create', compact('polizas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'nombre_equipo'      => 'required',
            'tipo_equipo'        => 'required',
            'marca'              => 'nullable',
            'modelo'             => 'nullable',
            'numero_serie'       => 'nullable',
            'ip'                 => 'nullable|ip',
            'observaciones'      => 'nullable'
        ]);

        InventarioCliente::create($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Equipo registrado correctamente.');
    }

    public function edit($id)
    {
        $equipo = InventarioCliente::findOrFail($id);
        $polizas = PolizaServicio::with('cliente')->get();
        return view('inventario_clientes.edit', compact('equipo', 'polizas'));
    }

    public function update(Request $request, $id)
    {
        $equipo = InventarioCliente::findOrFail($id);

        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'nombre_equipo'      => 'required',
            'tipo_equipo'        => 'required',
            'marca'              => 'nullable',
            'modelo'             => 'nullable',
            'numero_serie'       => 'nullable',
            'ip'                 => 'nullable|ip',
            'observaciones'      => 'nullable'
        ]);

        $equipo->update($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $equipo = InventarioCliente::findOrFail($id);
        $equipo->delete();

        return redirect()->route('servicios_empresariales.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
