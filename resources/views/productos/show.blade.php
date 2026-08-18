@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
    <a class="back-link" href="{{ route('productos.index') }}">← Volver a productos</a>

    <section class="detail-header">
        <div>
            <p class="kicker">Detalle de producto #{{ $producto->id }}</p>
            <h1>{{ $producto->nombre }}</h1>
        </div>
        <div class="detail-actions">
            <a class="button button-secondary" href="{{ route('productos.edit', $producto) }}">Editar producto</a>
            <form class="inline-form" action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?');">
                @csrf
                @method('DELETE')
                <button class="button button-danger" type="submit">Eliminar</button>
            </form>
        </div>
    </section>

    <section class="surface" aria-labelledby="detail-title">
        <h2 id="detail-title" class="sr-only">Información del producto</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Identificador</span>
                <strong class="detail-value">#{{ $producto->id }}</strong>
            </div>
            <div class="detail-item">
                <span class="detail-label">Precio unitario</span>
                <strong class="detail-value">$ {{ number_format((float) $producto->precio, 2, ',', '.') }}</strong>
            </div>
            <div class="detail-item">
                <span class="detail-label">Stock disponible</span>
                <strong class="detail-value">{{ $producto->stock }} unidades</strong>
            </div>
        </div>
        <div class="description-block">
            <p class="detail-label">Descripción</p>
            <p>{{ $producto->descripcion ?: 'Sin descripción cargada.' }}</p>
        </div>
    </section>
@endsection
