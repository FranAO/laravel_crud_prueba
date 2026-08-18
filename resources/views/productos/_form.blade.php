@php
    $editing = isset($producto);
    $precio = old('precio', $editing ? number_format((float) $producto->precio, 2, '.', '') : '');
    $stock = old('stock', $editing ? $producto->stock : '');
@endphp

<div class="form-grid">
    <div class="field field-full">
        <label for="nombre">Nombre del producto</label>
        <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $editing ? $producto->nombre : '') }}" maxlength="255" required autofocus placeholder="Ej. Café molido">
        @error('nombre') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field field-full">
        <label for="descripcion">Descripción <span class="muted">(opcional)</span></label>
        <textarea id="descripcion" name="descripcion" maxlength="1000" placeholder="Agregá una descripción breve">{{ old('descripcion', $editing ? $producto->descripcion : '') }}</textarea>
        <p class="field-hint">Hasta 1000 caracteres.</p>
        @error('descripcion') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="precio">Precio unitario</label>
        <input id="precio" name="precio" type="number" value="{{ $precio }}" min="0" max="999999.99" step="0.01" required placeholder="0.00">
        @error('precio') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="stock">Stock disponible</label>
        <input id="stock" name="stock" type="number" value="{{ $stock }}" min="0" step="1" required placeholder="0">
        @error('stock') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-actions">
    <button class="button button-primary" type="submit">{{ $editing ? 'Guardar cambios' : 'Guardar producto' }}</button>
    <a class="button button-secondary" href="{{ $editing ? route('productos.show', $producto) : route('productos.index') }}">Cancelar</a>
</div>
