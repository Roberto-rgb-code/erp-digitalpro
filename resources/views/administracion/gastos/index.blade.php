@extends('layouts.app')

@section('page_title', 'Gastos Generales')

@section('content')
<div class="container">
    <h2 class="mb-4">Gastos Generales</h2>
    <a href="{{ route('gastos.create') }}" class="btn btn-primary mb-3">Nuevo Gasto</a>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($gastos as $gasto)
            <tr>
                <td>{{ $gasto->concepto }}</td>
                <td>${{ number_format($gasto->monto,2) }}</td>
                <td>{{ $gasto->fecha }}</td>
                <td>{{ $gasto->categoria->nombre ?? '-' }}</td>
                <td>{{ $gasto->proveedor->nombre ?? '-' }}</td>
                <td>
                    @if($gasto->documento)
                        <a href="{{ asset('storage/'.$gasto->documento) }}" target="_blank">Ver</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('gastos.edit', $gasto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No hay gastos registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $gastos->links() }}
</div>
@endsection
