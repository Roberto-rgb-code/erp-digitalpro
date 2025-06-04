@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cliente</h2>

    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data" id="formCliente">
        @csrf
        @method('PUT')

        {{-- Los mismos campos que en create, pero usa los valores de $cliente y sus relaciones --}}
        {{-- ...Mismo contenido que create.blade.php pero en los value pones: --}}
        {{-- value="{{ old('nombre', $cliente->nombre) }}" --}}
        {{-- value="{{ old('rfc', $cliente->fiscal->rfc ?? '') }}" --}}
        {{-- checked="{{ old('requiere_factura', $cliente->requiere_factura) ? 'checked' : '' }}" --}}
        {{-- etc. --}}

        {{-- Puedes reutilizar el mismo JS del push --}}
    </form>
</div>
@endsection
