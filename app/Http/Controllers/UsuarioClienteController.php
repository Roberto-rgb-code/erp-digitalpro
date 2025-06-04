<?php

namespace App\Http\Controllers;

use App\Models\UsuarioCliente;
use App\Models\PolizaServicio;
use Illuminate\Http\Request;

class UsuarioClienteController extends Controller
{
    public function index()
    {
        $usuarios = UsuarioCliente::with('poliza.cliente')->latest()->paginate(10);
        return view('usuario_clientes.index', compact('usuarios'));
    }

    public function create()
    {
        $polizas = PolizaServicio::with('cliente')->get();
        return view('usuario_clientes.create', compact('polizas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'nombre_usuario'     => 'required',
            'rol'                => 'nullable',
            'usuario_acceso'     => 'nullable',
            'password_acceso'    => 'nullable',
            'observaciones'      => 'nullable'
        ]);

        UsuarioCliente::create($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Usuario registrado correctamente.');
    }

    public function edit($id)
    {
        $usuario = UsuarioCliente::findOrFail($id);
        $polizas = PolizaServicio::with('cliente')->get();
        return view('usuario_clientes.edit', compact('usuario', 'polizas'));
    }

    public function update(Request $request, $id)
    {
        $usuario = UsuarioCliente::findOrFail($id);

        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'nombre_usuario'     => 'required',
            'rol'                => 'nullable',
            'usuario_acceso'     => 'nullable',
            'password_acceso'    => 'nullable',
            'observaciones'      => 'nullable'
        ]);

        $usuario->update($request->all());

        return redirect()->route('servicios_empresariales.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = UsuarioCliente::findOrFail($id);
        $usuario->delete();

        return redirect()->route('servicios_empresariales.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
