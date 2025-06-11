<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteTipo;
use App\Models\UsoCfdi;
use App\Models\ClienteConfiguracion;
use App\Models\ClienteFiscal;
use App\Models\ClienteCredito;
use App\Models\ClienteDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $tipos = ClienteTipo::all();
        $usosCfdi = UsoCfdi::all();

        $clientes = Cliente::with(['tipo', 'configuracion', 'fiscal', 'credito'])
            ->when($request->nombre, fn($q) => $q->where('nombre', 'like', '%' . $request->nombre . '%'))
            ->when($request->folio, fn($q) => $q->where('folio', 'like', '%' . $request->folio . '%'))
            ->when($request->tipo_cliente_id, fn($q) => $q->where('tipo_cliente_id', $request->tipo_cliente_id))
            ->when($request->telefono, fn($q) => $q->where('telefono', 'like', '%' . $request->telefono . '%'))
            ->when($request->email, fn($q) => $q->where('email', 'like', '%' . $request->email . '%'))
            ->when($request->requiere_factura !== null && $request->requiere_factura !== '', function ($q) use ($request) {
                $q->whereHas('configuracion', fn($sub) => $sub->where('requiere_factura', $request->requiere_factura));
            })
            ->when($request->rfc, function ($q) use ($request) {
                $q->whereHas('fiscal', fn($sub) => $sub->where('rfc', 'like', '%' . $request->rfc . '%'));
            })
            ->when($request->uso_cfdi_id, function ($q) use ($request) {
                $q->whereHas('fiscal', fn($sub) => $sub->where('uso_cfdi_id', $request->uso_cfdi_id));
            })
            ->when($request->fecha_alta_inicio, function ($q) use ($request) {
                $q->whereDate('fecha_alta', '>=', $request->fecha_alta_inicio);
            })
            ->when($request->fecha_alta_fin, function ($q) use ($request) {
                $q->whereDate('fecha_alta', '<=', $request->fecha_alta_fin);
            })
            ->orderByDesc('id')
            ->paginate(15)
            ->appends($request->all());

        return view('clientes.index', compact('clientes', 'tipos', 'usosCfdi'));
    }

    public function create()
    {
        $tipos = ClienteTipo::all();
        $usosCfdi = UsoCfdi::all();
        return view('clientes.create', compact('tipos', 'usosCfdi'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'tipo_cliente_id' => 'required|exists:cliente_tipos,id',
        ];

        if ($request->has('requiere_factura')) {
            $rules = array_merge($rules, [
                'rfc'           => ['required', 'regex:/^[A-Z&Ñ]{3,4}[0-9]{6}[A-Z0-9]{3}$/i'],
                'razon_social'  => 'required|string',
                'uso_cfdi_id'   => 'required|exists:usos_cfdi,id',
                'calle'         => 'required|string',
                'numero'        => 'required|string',
                'colonia'       => 'required|string',
                'cp'            => 'required|string',
                'municipio'     => 'required|string',
                'estado'        => 'required|string',
            ]);
        }

        if ($request->has('tiene_linea')) {
            $rules = array_merge($rules, [
                'limite_credito' => 'required|numeric|min:0',
                'dias_credito'   => 'required|integer|min:1',
            ]);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'regex'    => 'El campo :attribute no tiene un formato válido.',
            'email'    => 'El campo :attribute debe ser un correo válido.',
            'exists'   => 'El valor seleccionado para :attribute no es válido.',
            'numeric'  => 'El campo :attribute debe ser un número.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'min'      => 'El campo :attribute debe ser mayor a cero.',
        ];

        $this->validate($request, $rules, $messages);

        DB::beginTransaction();
        try {
            $cliente = Cliente::create([
                'folio' => self::generarFolio(),
                'nombre' => $request->nombre,
                'tipo_cliente_id' => $request->tipo_cliente_id,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'fecha_alta' => now(),
            ]);

            if ($request->has('requiere_factura')) {
                ClienteConfiguracion::create([
                    'cliente_id' => $cliente->id,
                    'requiere_factura' => $request->requiere_factura ? 1 : 0,
                ]);
                ClienteFiscal::create([
                    'cliente_id' => $cliente->id,
                    'rfc' => $request->rfc,
                    'razon_social' => $request->razon_social,
                    'uso_cfdi_id' => $request->uso_cfdi_id,
                    'calle' => $request->calle,
                    'numero' => $request->numero,
                    'colonia' => $request->colonia,
                    'cp' => $request->cp,
                    'municipio' => $request->municipio,
                    'estado' => $request->estado,
                ]);
            }

            if ($request->has('tiene_linea')) {
                ClienteCredito::create([
                    'cliente_id' => $cliente->id,
                    'tiene_linea' => $request->tiene_linea ? 1 : 0,
                    'limite_credito' => $request->limite_credito,
                    'dias_credito' => $request->dias_credito,
                ]);
            }

            if ($request->hasFile('documentos')) {
                foreach ($request->file('documentos') as $tipo => $file) {
                    if ($file) {
                        $path = $file->store('clientes/documentos', 'public');
                        ClienteDocumento::create([
                            'cliente_id' => $cliente->id,
                            'tipo_doc' => $tipo,
                            'archivo' => $path,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al guardar cliente: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $cliente = Cliente::with(['tipo', 'configuracion', 'fiscal', 'credito', 'documentos'])->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::with(['tipo', 'configuracion', 'fiscal', 'credito', 'documentos'])->findOrFail($id);
        $tipos = ClienteTipo::all();
        $usosCfdi = UsoCfdi::all();
        return view('clientes.edit', compact('cliente', 'tipos', 'usosCfdi'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required|string',
            'tipo_cliente_id' => 'required|exists:cliente_tipos,id',
        ];

        if ($request->has('requiere_factura')) {
            $rules = array_merge($rules, [
                'rfc'           => ['required', 'regex:/^[A-Z&Ñ]{3,4}[0-9]{6}[A-Z0-9]{3}$/i'],
                'razon_social'  => 'required|string',
                'uso_cfdi_id'   => 'required|exists:usos_cfdi,id',
                'calle'         => 'required|string',
                'numero'        => 'required|string',
                'colonia'       => 'required|string',
                'cp'            => 'required|string',
                'municipio'     => 'required|string',
                'estado'        => 'required|string',
            ]);
        }

        if ($request->has('tiene_linea')) {
            $rules = array_merge($rules, [
                'limite_credito' => 'required|numeric|min:0',
                'dias_credito'   => 'required|integer|min:1',
            ]);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'regex'    => 'El campo :attribute no tiene un formato válido.',
            'exists'   => 'El valor seleccionado para :attribute no es válido.',
        ];

        $this->validate($request, $rules, $messages);

        DB::beginTransaction();
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update([
                'nombre' => $request->nombre,
                'tipo_cliente_id' => $request->tipo_cliente_id,
                'telefono' => $request->telefono,
                'email' => $request->email,
            ]);

            $config = $cliente->configuracion ?: new ClienteConfiguracion(['cliente_id' => $cliente->id]);
            $config->requiere_factura = $request->requiere_factura ? 1 : 0;
            $config->save();

            if ($request->has('requiere_factura')) {
                $fiscal = $cliente->fiscal ?: new ClienteFiscal(['cliente_id' => $cliente->id]);
                $fiscal->rfc = $request->rfc;
                $fiscal->razon_social = $request->razon_social;
                $fiscal->uso_cfdi_id = $request->uso_cfdi_id;
                $fiscal->calle = $request->calle;
                $fiscal->numero = $request->numero;
                $fiscal->colonia = $request->colonia;
                $fiscal->cp = $request->cp;
                $fiscal->municipio = $request->municipio;
                $fiscal->estado = $request->estado;
                $fiscal->save();
            }

            if ($request->has('tiene_linea')) {
                $credito = $cliente->credito ?: new ClienteCredito(['cliente_id' => $cliente->id]);
                $credito->tiene_linea = $request->tiene_linea ? 1 : 0;
                $credito->limite_credito = $request->limite_credito;
                $credito->dias_credito = $request->dias_credito;
                $credito->save();
            }

            if ($request->hasFile('documentos')) {
                foreach ($request->file('documentos') as $tipo => $file) {
                    if ($file) {
                        $path = $file->store('clientes/documentos', 'public');
                        ClienteDocumento::create([
                            'cliente_id' => $cliente->id,
                            'tipo_doc' => $tipo,
                            'archivo' => $path,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('clientes.show', $cliente->id)->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al actualizar cliente: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public static function generarFolio()
    {
        $num = Cliente::count() + 1;
        return 'CLI' . str_pad($num, 6, '0', STR_PAD_LEFT);
    }

    public function exportExcel()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }

    public function exportPdf()
    {
        $clientes = Cliente::with(['tipo', 'fiscal', 'credito', 'configuracion'])->get();
        $pdf = PDF::loadView('clientes.pdf', compact('clientes'))->setPaper('a4', 'landscape');
        return $pdf->download('clientes.pdf');
    }
}
