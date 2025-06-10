<div class="mb-3">
    <label>Nombre del vehículo</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $vehiculo->nombre) }}" required>
</div>

<div class="mb-3">
    <label>Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}" required>
</div>

<div class="mb-3">
    <label>Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}" required>
</div>

<div class="mb-3">
    <label>Año</label>
    <input type="number" name="anio" class="form-control" value="{{ old('anio', $vehiculo->anio) }}" required>
</div>

<div class="mb-3">
    <label>Placas</label>
    <input type="text" name="placas" class="form-control" value="{{ old('placas', $vehiculo->placas) }}" required>
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado" class="form-control" required>
        <option value="Disponible" {{ old('estado', $vehiculo->estado) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
        <option value="En uso" {{ old('estado', $vehiculo->estado) == 'En uso' ? 'selected' : '' }}>En uso</option>
        <option value="En servicio" {{ old('estado', $vehiculo->estado) == 'En servicio' ? 'selected' : '' }}>En servicio</option>
    </select>
</div>
