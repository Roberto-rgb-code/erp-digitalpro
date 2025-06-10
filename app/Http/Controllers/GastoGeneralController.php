<?php

// app/Http/Controllers/GastoGeneralController.php
namespace App\Http\Controllers;

use App\Models\GastoGeneral;
use App\Models\CategoriaGasto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class GastoGeneralController extends Controller
{
    public function index()
    {
        $gastos = GastoGeneral::with(['categoria', 'proveedor'])->orderBy('fecha', 'desc')->paginate(10);
        return view('administracion.gastos.index', compact('gastos'));
    }

    public function create()
    {
        $categorias = CategoriaGasto::all();
        $proveedores = Cliente::all();
        return view('administracion.gastos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'categoria_id' => 'nullable|exists:categoria_gastos,id',
            'proveedor_id' => 'nullable|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'documento' => 'nullable|file|max:2048'
        ]);

        if ($request->hasFile('documento')) {
            $data['documento'] = $request->file('documento')->store('gastos/documentos');
        }

        GastoGeneral::create($data);

        return redirect()->route('gastos.index')->with('success', 'Gasto registrado');
    }

    public function edit($id)
    {
        $gasto = GastoGeneral::findOrFail($id);
        $categorias = CategoriaGasto::all();
        $proveedores = Cliente::all();
        return view('administracion.gastos.edit', compact('gasto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $gasto = GastoGeneral::findOrFail($id);
        $data = $request->validate([
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'categoria_id' => 'nullable|exists:categoria_gastos,id',
            'proveedor_id' => 'nullable|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'documento' => 'nullable|file|max:2048'
        ]);

        if ($request->hasFile('documento')) {
            $data['documento'] = $request->file('documento')->store('gastos/documentos');
        }

        $gasto->update($data);

        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado');
    }

    public function destroy($id)
    {
        $gasto = GastoGeneral::findOrFail($id);
        $gasto->delete();
        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado');
    }
}
