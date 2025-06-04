<?php

namespace App\Http\Controllers;

use App\Models\TicketSoporte;
use App\Models\PolizaServicio;
use Illuminate\Http\Request;

class TicketSoporteController extends Controller
{
    // Mostrar listado de tickets (opcional: si quieres tenerlo como página aparte)
    public function index()
    {
        $tickets = TicketSoporte::with(['poliza.cliente'])->orderBy('created_at', 'desc')->paginate(10);
        return view('ticket_soportes.index', compact('tickets'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $polizas = PolizaServicio::with('cliente')->get();
        return view('ticket_soportes.create', compact('polizas'));
    }

    // Guardar nuevo ticket
    public function store(Request $request)
    {
        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|string',
            'estado' => 'required|string',
        ]);

        $folio = 'TK-' . strtoupper(uniqid());

        TicketSoporte::create([
            'poliza_servicio_id' => $request->poliza_servicio_id,
            'folio' => $folio,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
        ]);

        return redirect()->route('servicios_empresariales.index')->with('success', 'Ticket creado correctamente.');
    }

    // Mostrar un ticket
    public function show($id)
    {
        $ticket = TicketSoporte::with('poliza.cliente')->findOrFail($id);
        return view('ticket_soportes.show', compact('ticket'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $ticket = TicketSoporte::findOrFail($id);
        $polizas = PolizaServicio::with('cliente')->get();
        return view('ticket_soportes.create', compact('ticket', 'polizas'));
    }

    // Actualizar ticket
    public function update(Request $request, $id)
    {
        $ticket = TicketSoporte::findOrFail($id);

        $request->validate([
            'poliza_servicio_id' => 'required|exists:poliza_servicios,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|string',
            'estado' => 'required|string',
        ]);

        $ticket->update([
            'poliza_servicio_id' => $request->poliza_servicio_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
        ]);

        return redirect()->route('servicios_empresariales.index')->with('success', 'Ticket actualizado correctamente.');
    }

    // Eliminar ticket
    public function destroy($id)
    {
        $ticket = TicketSoporte::findOrFail($id);
        $ticket->delete();

        return redirect()->route('servicios_empresariales.index')->with('success', 'Ticket eliminado correctamente.');
    }
}
