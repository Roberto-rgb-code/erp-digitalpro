@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cliente</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-triangle-fill"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data" id="formCliente">
        @csrf
        @method('PUT')

        {{-- Datos generales --}}
        <div class="card mb-4">
            <div class="card-header">Datos Generales</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label>Nombre completo / Empresa *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Tipo de Cliente *</label>
                    <select name="tipo_cliente_id" class="form-select" required>
                        <option value="">Selecciona...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('tipo_cliente_id', $cliente->tipo_cliente_id) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Teléfono / WhatsApp</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <input type="checkbox" name="requiere_factura" id="requiereFactura" value="1"
                        {{ old('requiere_factura', $cliente->configuracion->requiere_factura ?? false) ? 'checked' : '' }}>
                    <label class="ms-2" for="requiereFactura">¿Requiere factura?</label>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <input type="checkbox" name="tiene_linea" id="tieneLinea" value="1"
                        {{ old('tiene_linea', $cliente->credito->tiene_linea ?? false) ? 'checked' : '' }}>
                    <label class="ms-2" for="tieneLinea">¿Tiene línea de crédito?</label>
                </div>
            </div>
        </div>

        {{-- Datos fiscales --}}
        <div class="card mb-4 d-none" id="cardFiscal">
            <div class="card-header">Datos Fiscales</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>RFC *</label>
                    <input type="text" name="rfc" value="{{ old('rfc', $cliente->fiscal->rfc ?? '') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Razón Social *</label>
                    <input type="text" name="razon_social" value="{{ old('razon_social', $cliente->fiscal->razon_social ?? '') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Uso CFDI *</label>
                    <select name="uso_cfdi_id" class="form-select">
                        <option value="">Selecciona...</option>
                        @foreach($usosCfdi as $uso)
                            <option value="{{ $uso->id }}"
                                {{ old('uso_cfdi_id', $cliente->fiscal->uso_cfdi_id ?? '') == $uso->id ? 'selected' : '' }}>
                                {{ $uso->clave }} - {{ $uso->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Calle *</label>
                    <input type="text" name="calle" value="{{ old('calle', $cliente->fiscal->calle ?? '') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Número *</label>
                    <input type="text" name="numero" value="{{ old('numero', $cliente->fiscal->numero ?? '') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Colonia *</label>
                    <input type="text" name="colonia" value="{{ old('colonia', $cliente->fiscal->colonia ?? '') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>CP *</label>
                    <input type="text" name="cp" value="{{ old('cp', $cliente->fiscal->cp ?? '') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Municipio *</label>
                    <input type="text" name="municipio" value="{{ old('municipio', $cliente->fiscal->municipio ?? '') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Estado *</label>
                    <input type="text" name="estado" value="{{ old('estado', $cliente->fiscal->estado ?? '') }}" class="form-control">
                </div>
            </div>
        </div>

        {{-- Crédito --}}
        <div class="card mb-4 d-none" id="cardCredito">
            <div class="card-header">Datos de Crédito</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>Límite de crédito *</label>
                    <input type="number" step="0.01" name="limite_credito"
                        value="{{ old('limite_credito', $cliente->credito->limite_credito ?? '') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Días de crédito *</label>
                    <input type="number" name="dias_credito"
                        value="{{ old('dias_credito', $cliente->credito->dias_credito ?? 7) }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="mb-4 text-end">
            <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Guardar cambios</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function mostrarOcultarCards() {
    document.getElementById('cardFiscal').classList.toggle('d-none', !document.getElementById('requiereFactura').checked);
    document.getElementById('cardCredito').classList.toggle('d-none', !document.getElementById('tieneLinea').checked);
}
document.addEventListener("DOMContentLoaded", function() {
    mostrarOcultarCards();
    document.getElementById('requiereFactura').addEventListener('change', mostrarOcultarCards);
    document.getElementById('tieneLinea').addEventListener('change', mostrarOcultarCards);
});
</script>
@endpush
