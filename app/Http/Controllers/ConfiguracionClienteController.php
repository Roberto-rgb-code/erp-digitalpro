<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionCliente;
use App\Models\PolizaServicio;
use Illuminate\Http\Request;

class ConfiguracionClienteController extends Controller
{
    public function index()
    {
        $configuraciones = ConfiguracionCliente::with('poliza.cliente')->latest()->paginate(10);
        return view('configuracion_clientes.index', compact('configuraciones'));
    }

    public function create()
    {
        $polizas = PolizaServicio::with('cliente')->get();
        return view('configuracion_clientes.create', compact('polizas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'tipo_red'           => 'nullable',
            'ip_publica'         => 'nullable|ip',
            'ip_privada'         => 'nullable|ip',
            'gateway'            => 'nullable|ip',
            'dns'                => 'nullable',
            'software_instalado' => 'nullable',
            'accesos'            => 'nullable',
            'notas'              => 'nullable'
        ]);

        ConfiguracionCliente::create($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Configuración registrada correctamente.');
    }

    public function edit($id)
    {
        $configuracion = ConfiguracionCliente::findOrFail($id);
        $polizas = PolizaServicio::with('cliente')->get();
        return view('configuracion_clientes.edit', compact('configuracion', 'polizas'));
    }

    public function update(Request $request, $id)
    {
        $configuracion = ConfiguracionCliente::findOrFail($id);

        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'tipo_red'           => 'nullable',
            'ip_publica'         => 'nullable|ip',
            'ip_privada'         => 'nullable|ip',
            'gateway'            => 'nullable|ip',
            'dns'                => 'nullable',
            'software_instalado' => 'nullable',
            'accesos'            => 'nullable',
            'notas'              => 'nullable'
        ]);

        $configuracion->update($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Configuración actualizada correctamente.');
    }

    public function destroy($id)
    {
        $configuracion = ConfiguracionCliente::findOrFail($id);
        $configuracion->delete();

        return redirect()->route('servicios_empresariales.index')->with('success', 'Configuración eliminada correctamente.');
    }
}
