<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Empleado;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('empleado')->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('vehiculos.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca_modelo_anio' => 'required|string|max:255',
            'placas' => 'required|string|max:20|unique:vehiculos',
            'kilometraje_actual' => 'required|integer|min:0',
            'estado_actual' => 'required|in:Disponible,En uso,En servicio',
            'empleado_id' => 'nullable|exists:empleados,id',
        ]);

        Vehiculo::create($request->all());
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $empleados = Empleado::all();
        return view('vehiculos.edit', compact('vehiculo', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca_modelo_anio' => 'required|string|max:255',
            'placas' => 'required|string|max:20|unique:vehiculos,placas,' . $vehiculo->id,
            'kilometraje_actual' => 'required|integer|min:0',
            'estado_actual' => 'required|in:Disponible,En uso,En servicio',
            'empleado_id' => 'nullable|exists:empleados,id',
        ]);

        $vehiculo->update($request->all());
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        Vehiculo::destroy($id);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
    }
}
