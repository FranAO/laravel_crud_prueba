@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
    <div class="form-shell">
        <a class="back-link" href="{{ route('productos.show', $producto) }}">← Volver al detalle</a>
        <div class="page-heading">
            <div>
                <p class="kicker">Editar registro #{{ $producto->id }}</p>
                <h1>Actualizar producto</h1>
                <p class="lede">Modificá la información y guardá los cambios en el inventario.</p>
            </div>
        </div>

        <section class="surface form-panel" aria-labelledby="edit-title">
            <h2 id="edit-title" class="sr-only">Datos del producto</h2>
            <form action="{{ route('productos.update', $producto) }}" method="POST">
                @csrf
                @method('PUT')
                @include('productos._form')
            </form>
        </section>
    </div>
@endsection
