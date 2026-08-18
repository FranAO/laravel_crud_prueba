@extends('layouts.app')

@section('title', 'Nuevo producto')

@section('content')
    <div class="form-shell">
        <a class="back-link" href="{{ route('productos.index') }}">← Volver a productos</a>
        <div class="page-heading">
            <div>
                <p class="kicker">Nuevo registro</p>
                <h1>Registrar producto</h1>
                <p class="lede">Completá los datos básicos para sumar un producto al inventario.</p>
            </div>
        </div>

        <section class="surface form-panel" aria-labelledby="create-title">
            <h2 id="create-title" class="sr-only">Datos del producto</h2>
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                @include('productos._form')
            </form>
        </section>
    </div>
@endsection
