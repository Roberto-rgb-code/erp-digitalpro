@extends('layouts.app')

@section('page_title', isset($gasto) ? 'Editar Gasto' : 'Nuevo Gasto')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($gasto) ? 'Editar Gasto' : 'Registrar Gasto' }}</h2>
    <form action="{{ isset($gasto) ? route('gastos.update', $gasto->id) : route('gastos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($gasto)) @method('PUT') @endif
        <div class="mb-3">
            <label class="form-label">Concepto</label>
            <input type="text" name="concepto" class="form-control" value="{{ old('concepto', $gasto->concepto ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Monto</label>
            <input type="number" step="0.01" name="monto" class="form-control" value="{{ old('monto', $gasto->monto ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $gasto->fecha ?? date('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                <option value="">-- Selecciona --</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @if(old('categoria_id', $gasto->categoria_id ?? '')==$cat->id) selected @endif>{{ $cat->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Proveedor</label>
            <select name="proveedor_id" class="form-select">
                <option value="">-- Selecciona --</option>
                @foreach($proveedores as $prov)
                    <option value="{{ $prov->id }}" @if(old('proveedor_id', $gasto->proveedor_id ?? '')==$prov->id) selected @endif>{{ $prov->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $gasto->descripcion ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Documento (opcional)</label>
            <input type="file" name="documento" class="form-control">
            @if(isset($gasto) && $gasto->documento)
                <a href="{{ asset('storage/'.$gasto->documento) }}" target="_blank">Ver documento</a>
            @endif
        </div>
        <button class="btn btn-success" type="submit">{{ isset($gasto) ? 'Actualizar' : 'Registrar' }}</button>
        <a href="{{ route('gastos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
