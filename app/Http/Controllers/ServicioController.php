<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\EstadoOrdenServicio;
use App\Models\DiagnosticoServicio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $query = OrdenServicio::with('estado');

        // Filtros avanzados
        if ($request->filled('estado_id')) {
            $query->where('estado_id', $request->estado_id);
        }
        if ($request->filled('folio')) {
            $query->where('folio', 'like', '%' . $request->folio . '%');
        }
        if ($request->filled('cliente')) {
            $query->where('tipo_cliente', 'like', '%' . $request->cliente . '%');
        }
        if ($request->filled('fecha_ingreso')) {
            $query->whereDate('fecha_ingreso', $request->fecha_ingreso);
        }

        $servicios = $query->latest()->paginate(10)->appends($request->all());

        // --- Gráfica de barras/pastel: Órdenes por estado ---
        $estadisticas = OrdenServicio::selectRaw('estado_id, count(*) as total')
            ->groupBy('estado_id')
            ->with('estado')
            ->get()
            ->map(function($item) {
                return [
                    'estado' => $item->estado ? $item->estado->nombre : 'Sin estado',
                    'total' => $item->total
                ];
            });

        // --- Gráfica de líneas: órdenes por día (últimos 10 días) ---
        $dias = collect();
        $fechas = [];
        for ($i = 9; $i >= 0; $i--) {
            $fecha = now()->subDays($i)->format('Y-m-d');
            $fechas[] = $fecha;
            $dias[$fecha] = 0;
        }
        $ordenesPorDia = OrdenServicio::whereBetween('fecha_ingreso', [now()->subDays(9)->format('Y-m-d'), now()->format('Y-m-d')])
            ->selectRaw('fecha_ingreso, count(*) as total')
            ->groupBy('fecha_ingreso')
            ->pluck('total', 'fecha_ingreso');
        foreach ($ordenesPorDia as $fecha => $total) {
            $dias[$fecha] = $total;
        }

        return view('servicios.index', compact('servicios', 'estadisticas', 'dias', 'fechas'));
    }

    // ...resto del CRUD igual que antes...

    public function create()
    {
        $estados = EstadoOrdenServicio::all();
        return view('servicios.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'folio' => 'required|unique:ordenes_servicio,folio',
            'tipo_cliente' => 'required',
            'fecha_ingreso' => 'required|date',
            'estado_id' => 'required|exists:estados_orden_servicio,id',
        ]);

        $orden = OrdenServicio::create($request->only([
            'cliente_id', 'tipo_cliente', 'folio', 'imei', 'fecha_ingreso', 'estado_id', 'descripcion'
        ]));

        if ($request->filled('problema') || $request->filled('solucion') || $request->filled('observaciones')) {
            DiagnosticoServicio::create([
                'orden_servicio_id' => $orden->id,
                'problema' => $request->problema,
                'solucion' => $request->solucion,
                'observaciones' => $request->observaciones,
            ]);
        }

        return redirect()->route('servicios.index')->with('success', 'Orden de servicio creada correctamente.');
    }

    public function show($id)
    {
        $orden = OrdenServicio::with('estado')->findOrFail($id);
        $diagnostico = DiagnosticoServicio::where('orden_servicio_id', $orden->id)->first();
        return view('servicios.show', compact('orden', 'diagnostico'));
    }

    public function edit($id)
    {
        $orden = OrdenServicio::findOrFail($id);
        $diagnostico = DiagnosticoServicio::where('orden_servicio_id', $orden->id)->first();
        $estados = EstadoOrdenServicio::all();
        return view('servicios.edit', compact('orden', 'diagnostico', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $orden = OrdenServicio::findOrFail($id);

        $request->validate([
            'folio' => 'required|unique:ordenes_servicio,folio,'.$orden->id,
            'tipo_cliente' => 'required',
            'fecha_ingreso' => 'required|date',
            'estado_id' => 'required|exists:estados_orden_servicio,id',
        ]);

        $orden->update($request->only([
            'cliente_id', 'tipo_cliente', 'folio', 'imei', 'fecha_ingreso', 'estado_id', 'descripcion'
        ]));

        $diagnostico = DiagnosticoServicio::where('orden_servicio_id', $orden->id)->first();
        if ($diagnostico) {
            $diagnostico->update([
                'problema' => $request->problema,
                'solucion' => $request->solucion,
                'observaciones' => $request->observaciones,
            ]);
        } elseif ($request->filled('problema') || $request->filled('solucion') || $request->filled('observaciones')) {
            DiagnosticoServicio::create([
                'orden_servicio_id' => $orden->id,
                'problema' => $request->problema,
                'solucion' => $request->solucion,
                'observaciones' => $request->observaciones,
            ]);
        }

        return redirect()->route('servicios.index')->with('success', 'Orden de servicio actualizada correctamente.');
    }

    public function destroy($id)
    {
        $orden = OrdenServicio::findOrFail($id);
        DiagnosticoServicio::where('orden_servicio_id', $orden->id)->delete();
        $orden->delete();

        return redirect()->route('servicios.index')->with('success', 'Orden de servicio eliminada correctamente.');
    }

    public function pdf($id)
    {
        $orden = OrdenServicio::with('estado')->findOrFail($id);
        $diagnostico = DiagnosticoServicio::where('orden_servicio_id', $orden->id)->first();
        $pdf = Pdf::loadView('servicios.pdf', compact('orden', 'diagnostico'));
        return $pdf->download('orden_servicio_'.$orden->folio.'.pdf');
    }
}
