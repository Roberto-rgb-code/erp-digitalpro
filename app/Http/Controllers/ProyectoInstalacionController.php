<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoInstalacion;
use App\Models\TipoProyecto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\InventarioProyecto;
use App\Models\ReporteActividad;

class ProyectoInstalacionController extends Controller
{
    // Listado y dashboard
    public function index()
    {
        $proyectos = ProyectoInstalacion::with(['cliente', 'tipoProyecto', 'responsable'])->orderBy('created_at', 'desc')->paginate(10);

        $totalProyectos = ProyectoInstalacion::count();
        $proyectosActivos = ProyectoInstalacion::where('estado', 'En curso')->count();
        $proyectosFinalizados = ProyectoInstalacion::where('estado', 'Finalizado')->count();
        $materialesTotales = InventarioProyecto::sum('cantidad');
        $avancePromedio = ProyectoInstalacion::avg('avance');
        $tipos = TipoProyecto::withCount('proyectos')->get();

        return view('cableado.index', compact(
            'proyectos',
            'totalProyectos',
            'proyectosActivos',
            'proyectosFinalizados',
            'materialesTotales',
            'avancePromedio',
            'tipos'
        ));
    }

    // Formulario de creación
    public function create()
    {
        $clientes = Cliente::all();
        $tipos = TipoProyecto::all();
        $empleados = Empleado::all();
        return view('cableado.create', compact('clientes', 'tipos', 'empleados'));
    }

    // Guardar nuevo proyecto
    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|unique:proyectos_instalacion,nombre',
            'cliente_id'     => 'required|exists:clientes,id',
            'tipo_proyecto_id' => 'required|exists:tipo_proyectos,id',
            'direccion'      => 'required',
            'fecha_inicio'   => 'required|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_inicio',
            'responsable_id' => 'required|exists:empleados,id',
            'estado'         => 'required',
        ]);
        $proyecto = ProyectoInstalacion::create($request->all());
        return redirect()->route('cableado.show', $proyecto->id)->with('success', 'Proyecto creado exitosamente.');
    }

    // Mostrar detalles y tabs (avances, inventario, etc.)
    public function show($id)
    {
        $proyecto = ProyectoInstalacion::with(['cliente', 'tipoProyecto', 'responsable'])->findOrFail($id);
        $inventario = InventarioProyecto::where('proyecto_instalacion_id', $id)->get();
        $avances = ReporteActividad::where('proyecto_instalacion_id', $id)->latest()->get();
        return view('cableado.show', compact('proyecto', 'inventario', 'avances'));
    }

    // Formulario edición
    public function edit($id)
    {
        $proyecto = ProyectoInstalacion::findOrFail($id);
        $clientes = Cliente::all();
        $tipos = TipoProyecto::all();
        $empleados = Empleado::all();
        return view('cableado.edit', compact('proyecto', 'clientes', 'tipos', 'empleados'));
    }

    // Guardar cambios
    public function update(Request $request, $id)
    {
        $proyecto = ProyectoInstalacion::findOrFail($id);
        $request->validate([
            'nombre'         => 'required|unique:proyectos_instalacion,nombre,' . $proyecto->id,
            'cliente_id'     => 'required|exists:clientes,id',
            'tipo_proyecto_id' => 'required|exists:tipo_proyectos,id',
            'direccion'      => 'required',
            'fecha_inicio'   => 'required|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_inicio',
            'responsable_id' => 'required|exists:empleados,id',
            'estado'         => 'required',
        ]);
        $proyecto->update($request->all());
        return redirect()->route('cableado.show', $proyecto->id)->with('success', 'Proyecto actualizado.');
    }

    // Eliminar
    public function destroy($id)
    {
        $proyecto = ProyectoInstalacion::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('cableado.index')->with('success', 'Proyecto eliminado.');
    }
}
