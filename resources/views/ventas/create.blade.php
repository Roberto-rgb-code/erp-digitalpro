@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nueva Venta</h2>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-select" required>
                    <option value="">Selecciona...</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->folio }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="fecha_venta" class="form-label">Fecha de venta</label>
                <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-3">
                <label for="estado_id" class="form-label">Estado</label>
                <select name="estado_id" id="estado_id" class="form-select" required>
                    <option value="">Selecciona...</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Productos de la venta</label>
            <table class="table table-bordered" id="productos-table">
                <thead>
                    <tr>
                        <th>Producto/Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                        <th><button type="button" class="btn btn-success btn-sm" onclick="addProducto()"><i class="bi bi-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="productos[0][producto]" class="form-control" required></td>
                        <td><input type="number" name="productos[0][cantidad]" class="form-control" min="1" value="1" required></td>
                        <td><input type="number" name="productos[0][precio_unitario]" class="form-control" min="0" step="0.01" required></td>
                        <td><input type="number" class="form-control subtotal" disabled></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-3 row">
            <div class="col-md-3">
                <label for="total" class="form-label fw-bold">Total</label>
                <input type="number" name="total" id="total" class="form-control" readonly required>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" name="facturado" id="facturado" value="1">
                    <label class="form-check-label" for="facturado">Facturado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pagado" id="pagado" value="1">
                    <label class="form-check-label" for="pagado">Pagado</label>
                </div>
            </div>
            <div class="col-md-7">
                <label for="observaciones" class="form-label">Observaciones</label>
                <input type="text" name="observaciones" id="observaciones" class="form-control">
            </div>
        </div>
        <div class="mb-3 text-end">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar venta</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function addProducto() {
    let idx = $('#productos-table tbody tr').length;
    let row = `<tr>
        <td><input type="text" name="productos[${idx}][producto]" class="form-control" required></td>
        <td><input type="number" name="productos[${idx}][cantidad]" class="form-control" min="1" value="1" required></td>
        <td><input type="number" name="productos[${idx}][precio_unitario]" class="form-control" min="0" step="0.01" required></td>
        <td><input type="number" class="form-control subtotal" disabled></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove(); updateTotal();"><i class="bi bi-trash"></i></button></td>
    </tr>`;
    $('#productos-table tbody').append(row);
}

function updateTotal() {
    let total = 0;
    $('#productos-table tbody tr').each(function(){
        let cantidad = parseFloat($(this).find('input[name$="[cantidad]"]').val()) || 0;
        let precio = parseFloat($(this).find('input[name$="[precio_unitario]"]').val()) || 0;
        let subtotal = cantidad * precio;
        $(this).find('.subtotal').val(subtotal.toFixed(2));
        total += subtotal;
    });
    $('#total').val(total.toFixed(2));
}

$(document).on('input', 'input[name$="[cantidad]"], input[name$="[precio_unitario]"]', updateTotal);
$(document).ready(updateTotal);
</script>
@endpush
