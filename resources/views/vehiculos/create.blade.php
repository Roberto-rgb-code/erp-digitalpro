@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Vehículo</h1>

    <form action="{{ route('vehiculos.store') }}" method="POST">
        @csrf

        @include('vehiculos.form', ['vehiculo' => new \App\Models\Vehiculo])

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

