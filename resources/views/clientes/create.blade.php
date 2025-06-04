@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Cliente</h2>

    <form method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data" id="formCliente">
        @csrf

        {{-- Datos básicos --}}
        <div class="card mb-4">
            <div class="card-header">Datos Generales</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label>Nombre completo / Empresa *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Tipo de Cliente *</label>
                    <select name="tipo_cliente_id" class="form-select" required>
                        <option value="">Selecciona...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipo_cliente_id') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Teléfono / WhatsApp</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <input type="checkbox" name="requiere_factura" id="requiereFactura" value="1" {{ old('requiere_factura') ? 'checked' : '' }}>
                    <label class="ms-2" for="requiereFactura">¿Requiere factura?</label>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <input type="checkbox" name="tiene_linea" id="tieneLinea" value="1" {{ old('tiene_linea') ? 'checked' : '' }}>
                    <label class="ms-2" for="tieneLinea">¿Tiene línea de crédito?</label>
                </div>
            </div>
        </div>

        {{-- Datos Fiscales --}}
        <div class="card mb-4 d-none" id="cardFiscal">
            <div class="card-header">Datos Fiscales</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>RFC *</label>
                    <input type="text" name="rfc" value="{{ old('rfc') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Razón Social *</label>
                    <input type="text" name="razon_social" value="{{ old('razon_social') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Uso CFDI *</label>
                    <input type="text" name="uso_cfdi" value="{{ old('uso_cfdi') }}" class="form-control">
                </div>
                <div class="col-md-8">
                    <label>Dirección Fiscal Completa *</label>
                    <textarea name="direccion_fiscal" class="form-control">{{ old('direccion_fiscal') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Crédito --}}
        <div class="card mb-4 d-none" id="cardCredito">
            <div class="card-header">Datos de Crédito</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>Límite de crédito *</label>
                    <input type="number" step="0.01" name="limite_credito" value="{{ old('limite_credito') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Días de crédito *</label>
                    <input type="number" name="dias_credito" value="{{ old('dias_credito', 7) }}" class="form-control">
                </div>
            </div>
        </div>

        {{-- Documentos --}}
        <div class="card mb-4">
            <div class="card-header">Documentación</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>Contrato (PDF/JPG)</label>
                    <input type="file" name="documentos[contrato]" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Solicitud</label>
                    <input type="file" name="documentos[solicitud]" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Identificación</label>
                    <input type="file" name="documentos[identificacion]" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Cheques</label>
                    <input type="file" name="documentos[cheques]" class="form-control">
                </div>
            </div>
        </div>

        {{-- Botón --}}
        <div class="mb-4 text-end">
            <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Guardar cliente</button>
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
