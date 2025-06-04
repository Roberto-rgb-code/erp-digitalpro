<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\EstadoVenta;
use App\Models\ProductoVenta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::with(['cliente', 'estado']);

        if ($request->filled('folio')) {
            $query->where('folio', 'like', '%' . $request->folio . '%');
        }
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->filled('estado_id')) {
            $query->where('estado_id', $request->estado_id);
        }
        if ($request->filled('fecha_venta')) {
            $query->whereDate('fecha_venta', $request->fecha_venta);
        }

        $ventas = $query->orderBy('fecha_venta', 'desc')->paginate(10)->appends($request->all());
        $estados = EstadoVenta::all();
        $clientes = Cliente::all();

        // Dashboard - Gráfica 1: Ventas por Estado
        $estadosNombres = $estados->pluck('nombre');
        $ventasPorEstado = [];
        foreach($estados as $estado) {
            $ventasPorEstado[] = Venta::where('estado_id', $estado->id)->count();
        }

        // Gráfica 2 y 3: Ventas por Mes (últimos 6 meses)
        $meses = [];
        $ventasPorMes = [];
        $totalesPorMes = [];
        for ($i = 5; $i >= 0; $i--) {
            $mes = Carbon::now()->subMonths($i)->format('Y-m');
            $meses[] = Carbon::now()->subMonths($i)->format('M-Y');
            $ventasPorMes[] = Venta::whereRaw("to_char(fecha_venta, 'YYYY-MM') = ?", [$mes])->count();
            $totalesPorMes[] = Venta::whereRaw("to_char(fecha_venta, 'YYYY-MM') = ?", [$mes])->sum('total');
        }

        return view('ventas.index', compact(
            'ventas', 'estados', 'clientes',
            'estadosNombres', 'ventasPorEstado',
            'meses', 'ventasPorMes', 'totalesPorMes'
        ));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $estados = EstadoVenta::all();
        return view('ventas.create', compact('clientes', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_venta' => 'required|date',
            'estado_id' => 'required|exists:estado_ventas,id',
            'total' => 'required|numeric|min:0',
            'productos.*.producto' => 'required',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha_venta' => $request->fecha_venta,
            'estado_id' => $request->estado_id,
            'total' => $request->total,
            'facturado' => $request->facturado ?? false,
            'pagado' => $request->pagado ?? false,
            'observaciones' => $request->observaciones,
            'usuario_id' => auth()->id(),
        ]);

        foreach ($request->productos as $producto) {
            ProductoVenta::create([
                'venta_id' => $venta->id,
                'producto' => $producto['producto'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
                'subtotal' => $producto['cantidad'] * $producto['precio_unitario'],
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show($id)
    {
        $venta = Venta::with(['cliente', 'estado', 'productos', 'documentos'])->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }
}
