@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Vehículo</h1>

    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
        @csrf
        @method('PUT')

        @include('vehiculos.form', ['vehiculo' => $vehiculo])

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
