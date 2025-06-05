@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Proyectos de Cableado Estructurado</h2>
    <a href="{{ route('proyectos-instalacion.create') }}" class="btn btn-primary mb-3">Nuevo Proyecto</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Responsable</th>
                <th>Dirección</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        @foreach($proyectos as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->cliente->nombre ?? '-' }}</td>
                <td>{{ $p->tipoProyecto->nombre ?? '-' }}</td>
                <td>{{ $p->responsable->nombre ?? '-' }}</td>
                <td>{{ $p->direccion }}</td>
                <td>{{ $p->fecha_inicio }}</td>
                <td>{{ $p->fecha_fin }}</td>
                <td>{{ $p->estado }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $proyectos->links() }}
</div>
@endsection
