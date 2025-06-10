@extends('layouts.app')

@section('page_title', 'Empleados')

@section('content')
<div class="container">
    <h2 class="mb-4">Empleados</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha de ingreso</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->fecha_ingreso ?? '-' }}</td>
                    <td>{{ $empleado->estado ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
