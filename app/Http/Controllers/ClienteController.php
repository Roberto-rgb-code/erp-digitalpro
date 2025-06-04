<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;  // <--- ESTA LÍNEA


class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::with(['tipo', 'fiscal', 'credito']);

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }
        if ($request->filled('folio')) {
            $query->where('folio', 'like', '%' . $request->folio . '%');
        }
        if ($request->filled('tipo_cliente_id')) {
            $query->where('tipo_cliente_id', $request->tipo_cliente_id);
        }
        if ($request->filled('requiere_factura')) {
            $query->where('requiere_factura', $request->requiere_factura);
        }

        $clientes = $query->orderBy('nombre')->paginate(15)->appends($request->all());
        $tipos = TipoCliente::all();

        // Gráficas
        $tiposNombres = $tipos->pluck('nombre')->toArray();
        $clientesPorTipo = [];
        foreach($tipos as $tipo) {
            $clientesPorTipo[] = Cliente::where('tipo_cliente_id', $tipo->id)->count();
        }

        $requiere = Cliente::where('requiere_factura', true)->count();
        $noRequiere = Cliente::where('requiere_factura', false)->count();

        // Altas por mes (últimos 6 meses)
        $meses = [];
        $altasPorMes = [];
        for ($i = 5; $i >= 0; $i--) {
            $mes = Carbon::now()->subMonths($i)->format('Y-m');
            $meses[] = Carbon::now()->subMonths($i)->format('M-Y');
            $altasPorMes[] = Cliente::whereRaw("to_char(fecha_alta, 'YYYY-MM') = ?", [$mes])->count();
        }

        return view('clientes.index', compact(
            'clientes', 'tipos', 'tiposNombres', 'clientesPorTipo', 'requiere', 'noRequiere', 'meses', 'altasPorMes'
        ));
    }


    public function create()
    {
        $tipos = TipoCliente::all();
        return view('clientes.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        DB::transaction(function() use ($request) {
            $request->validate([
                'nombre' => 'required',
                'tipo_cliente_id' => 'required|exists:tipos_cliente,id',
                'telefono' => 'nullable',
                'email' => 'nullable|email',
                'requiere_factura' => 'nullable|boolean',
                // fiscales
                'rfc' => 'required_if:requiere_factura,1|nullable|regex:/^[A-ZÑ&]{3,4}\d{6}[A-Z\d]{3}$/i',
                'razon_social' => 'required_if:requiere_factura,1',
                'uso_cfdi' => 'required_if:requiere_factura,1',
                'direccion_fiscal' => 'required_if:requiere_factura,1',
                // crédito
                'tiene_linea' => 'nullable|boolean',
                'limite_credito' => 'required_if:tiene_linea,1|nullable|numeric',
                'dias_credito' => 'required_if:tiene_linea,1|nullable|integer',
            ], [
                'rfc.regex' => 'El RFC no es válido.',
            ]);

            $cliente = Cliente::create([
                'nombre' => $request->nombre,
                'tipo_cliente_id' => $request->tipo_cliente_id,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'requiere_factura' => $request->boolean('requiere_factura'),
                'fecha_alta' => now(),
                'activo' => true,
            ]);

            if ($request->requiere_factura) {
                ClienteFiscal::create([
                    'cliente_id' => $cliente->id,
                    'rfc' => $request->rfc,
                    'razon_social' => $request->razon_social,
                    'uso_cfdi' => $request->uso_cfdi,
                    'direccion_fiscal' => $request->direccion_fiscal,
                ]);
            }

            if ($request->tiene_linea) {
                ClienteCredito::create([
                    'cliente_id' => $cliente->id,
                    'tiene_linea' => true,
                    'limite_credito' => $request->limite_credito,
                    'dias_credito' => $request->dias_credito,
                ]);
            }

            // Documentos (puedes mejorar lógica para más tipos)
            if ($request->hasFile('documentos')) {
                foreach($request->file('documentos') as $tipo_doc => $archivo) {
                    $filename = $archivo->store('clientes/documentos');
                    ClienteDocumento::create([
                        'cliente_id' => $cliente->id,
                        'tipo_doc' => $tipo_doc,
                        'archivo' => $filename,
                    ]);
                }
            }
        });

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function show($id)
    {
        $cliente = Cliente::with(['tipo', 'fiscal', 'credito', 'documentos'])->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::with(['fiscal', 'credito', 'documentos'])->findOrFail($id);
        $tipos = TipoCliente::all();
        return view('clientes.edit', compact('cliente', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        DB::transaction(function() use ($request, $cliente) {
            $request->validate([
                'nombre' => 'required',
                'tipo_cliente_id' => 'required|exists:tipos_cliente,id',
                'telefono' => 'nullable',
                'email' => 'nullable|email',
                'requiere_factura' => 'nullable|boolean',
                // fiscales
                'rfc' => 'required_if:requiere_factura,1|nullable|regex:/^[A-ZÑ&]{3,4}\d{6}[A-Z\d]{3}$/i',
                'razon_social' => 'required_if:requiere_factura,1',
                'uso_cfdi' => 'required_if:requiere_factura,1',
                'direccion_fiscal' => 'required_if:requiere_factura,1',
                // crédito
                'tiene_linea' => 'nullable|boolean',
                'limite_credito' => 'required_if:tiene_linea,1|nullable|numeric',
                'dias_credito' => 'required_if:tiene_linea,1|nullable|integer',
            ], [
                'rfc.regex' => 'El RFC no es válido.',
            ]);

            $cliente->update([
                'nombre' => $request->nombre,
                'tipo_cliente_id' => $request->tipo_cliente_id,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'requiere_factura' => $request->boolean('requiere_factura'),
            ]);

            // Datos fiscales
            if ($request->requiere_factura) {
                $fiscal = $cliente->fiscal;
                if ($fiscal) {
                    $fiscal->update([
                        'rfc' => $request->rfc,
                        'razon_social' => $request->razon_social,
                        'uso_cfdi' => $request->uso_cfdi,
                        'direccion_fiscal' => $request->direccion_fiscal,
                    ]);
                } else {
                    ClienteFiscal::create([
                        'cliente_id' => $cliente->id,
                        'rfc' => $request->rfc,
                        'razon_social' => $request->razon_social,
                        'uso_cfdi' => $request->uso_cfdi,
                        'direccion_fiscal' => $request->direccion_fiscal,
                    ]);
                }
            } else {
                // Si ya tenía y ahora no, eliminar
                $cliente->fiscal?->delete();
            }

            // Datos crédito
            if ($request->tiene_linea) {
                $credito = $cliente->credito;
                if ($credito) {
                    $credito->update([
                        'tiene_linea' => true,
                        'limite_credito' => $request->limite_credito,
                        'dias_credito' => $request->dias_credito,
                    ]);
                } else {
                    ClienteCredito::create([
                        'cliente_id' => $cliente->id,
                        'tiene_linea' => true,
                        'limite_credito' => $request->limite_credito,
                        'dias_credito' => $request->dias_credito,
                    ]);
                }
            } else {
                $cliente->credito?->delete();
            }

            // Documentos (solo agregar, no borra anteriores)
            if ($request->hasFile('documentos')) {
                foreach($request->file('documentos') as $tipo_doc => $archivo) {
                    $filename = $archivo->store('clientes/documentos');
                    ClienteDocumento::create([
                        'cliente_id' => $cliente->id,
                        'tipo_doc' => $tipo_doc,
                        'archivo' => $filename,
                    ]);
                }
            }
        });

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
