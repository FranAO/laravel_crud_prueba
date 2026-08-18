@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <section class="page-heading">
        <div>
            <p class="kicker">Inventario local</p>
            <h1>Productos</h1>
            <p class="lede">Consultá, registrá y mantené actualizado tu catálogo desde un solo lugar.</p>
        </div>
        <a class="button button-primary" href="{{ route('productos.create') }}">Nuevo producto <span aria-hidden="true">+</span></a>
    </section>

    <section class="metrics" aria-label="Resumen del inventario">
        <article class="metric-card">
            <span class="metric-label">Productos registrados</span>
            <strong class="metric-value">{{ $totalProductos }}</strong>
            <span class="metric-note">Registros activos</span>
        </article>
        <article class="metric-card">
            <span class="metric-label">Unidades en stock</span>
            <strong class="metric-value">{{ number_format($stockTotal, 0, ',', '.') }}</strong>
            <span class="metric-note">Suma de existencias</span>
        </article>
        <article class="metric-card">
            <span class="metric-label">Valor estimado</span>
            <strong class="metric-value">$ {{ number_format($valorInventario, 2, ',', '.') }}</strong>
            <span class="metric-note">Precio por unidad x stock</span>
        </article>
    </section>

    <section class="surface" aria-labelledby="catalog-title">
        <div class="surface-head">
            <div>
                <h2 id="catalog-title">Catálogo actual</h2>
                <p>Información guardada en MySQL.</p>
            </div>
            <span class="muted">{{ $totalProductos }} {{ $totalProductos === 1 ? 'registro' : 'registros' }}</span>
        </div>

        @if ($productos->isEmpty())
            <div class="empty-state">
                <div class="empty-icon" aria-hidden="true">+</div>
                <h3>Tu catálogo está vacío</h3>
                <p>Creá tu primer producto para empezar a consultar el inventario.</p>
                <a class="button button-primary" href="{{ route('productos.create') }}">Registrar producto</a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col"><span class="sr-only">Acciones</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="cell-id">#{{ $producto->id }}</td>
                                <td>
                                    <span class="product-name">{{ $producto->nombre }}</span>
                                    <span class="product-description">{{ $producto->descripcion ?: 'Sin descripción' }}</span>
                                </td>
                                <td class="number">$ {{ number_format((float) $producto->precio, 2, ',', '.') }}</td>
                                <td>
                                    <span class="stock-badge @if ($producto->stock === 0) is-empty @endif">{{ $producto->stock }}</span>
                                </td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('productos.show', $producto) }}">Ver</a>
                                        <a href="{{ route('productos.edit', $producto) }}">Editar</a>
                                        <form class="inline-form" action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button button-plain" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
