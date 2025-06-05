<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoSoftware;
use App\Models\TipoSoftware;
use App\Models\Cliente;
use App\Models\Empleado;

class ProyectoSoftwareController extends Controller
{
    // LISTADO Y DASHBOARD
    public function index()
    {
        $proyectos = ProyectoSoftware::with(['cliente', 'tipo', 'responsable', 'modulos'])->paginate(10);

        // Gráfica de estados
        $estados = ['Planeado', 'En desarrollo', 'Testing', 'Finalizado'];
        $conteosEstados = [];
        foreach ($estados as $estado) {
            $conteosEstados[] = ProyectoSoftware::where('estado', $estado)->count();
        }

        // Gráfica de tipos
        $tipos = TipoSoftware::pluck('nombre')->toArray();
        $conteosTipos = [];
        foreach (TipoSoftware::all() as $tipo) {
            $conteosTipos[] = ProyectoSoftware::where('tipo_software_id', $tipo->id)->count();
        }

        // Avance promedio por proyecto
        $promediosAvance = ProyectoSoftware::with('modulos')->get()->map(function($p) {
            if ($p->modulos->count() > 0) {
                return round($p->modulos->avg('avance'), 2);
            }
            return 0;
        })->toArray();

        return view('proyectos_software.index', compact(
            'proyectos', 'estados', 'conteosEstados', 'tipos', 'conteosTipos', 'promediosAvance'
        ));
    }

    // FORMULARIO CREAR
    public function create()
    {
        $clientes = Cliente::all();
        $tipos = TipoSoftware::all();
        $empleados = Empleado::all();

        return view('proyectos_software.create', compact('clientes', 'tipos', 'empleados'));
    }

    // GUARDAR NUEVO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:proyecto_software,nombre',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_software_id' => 'required|exists:tipo_software,id',
            'fecha_inicio' => 'required|date',
            'fecha_entrega' => 'required|date',
            'responsable_id' => 'required|exists:empleados,id',
            'estado' => 'required'
        ]);

        ProyectoSoftware::create($request->all());
        return redirect()->route('proyectos_software.index')->with('success', 'Proyecto creado correctamente.');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $proyecto = ProyectoSoftware::findOrFail($id);
        $clientes = Cliente::all();
        $tipos = TipoSoftware::all();
        $empleados = Empleado::all();

        return view('proyectos_software.edit', compact('proyecto', 'clientes', 'tipos', 'empleados'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $proyecto = ProyectoSoftware::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:proyecto_software,nombre,'.$proyecto->id,
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_software_id' => 'required|exists:tipo_software,id',
            'fecha_inicio' => 'required|date',
            'fecha_entrega' => 'required|date',
            'responsable_id' => 'required|exists:empleados,id',
            'estado' => 'required'
        ]);

        $proyecto->update($request->all());
        return redirect()->route('proyectos_software.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    // SHOW
    public function show($id)
    {
        $proyecto = ProyectoSoftware::with(['cliente', 'tipo', 'responsable', 'modulos.entregas', 'modulos.feedbacks'])->findOrFail($id);
        return view('proyectos_software.show', compact('proyecto'));
    }

    // ELIMINAR
    public function destroy($id)
    {
        $proyecto = ProyectoSoftware::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('proyectos_software.index')->with('success', 'Proyecto eliminado correctamente.');
    }
}
