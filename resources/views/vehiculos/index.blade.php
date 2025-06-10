<!-- resources/views/vehiculos/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Listado de Vehículos</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Placas</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->nombre }}</td>
                    <td>{{ $vehiculo->placas }}</td>
                    <td>{{ $vehiculo->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
