<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('title', 'Carrito de Compras')

    @section('contenido')
    <div class="container mt-5 mb-5">
        <h1>Carrito de Compras</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($carrito && count($carrito) > 0)
            <div class="row">
                @foreach($carrito as $item)
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset($item->moto->imagen) }}" width="100" height="100" alt="{{ $item->moto->nombre }}" class="me-3">
                                <div class="flex-grow-1">
                                    <h5>{{ $item->moto->nombre }}</h5>
                                    <p>Precio: ${{ number_format($item->precio, 2) }}</p>
                                    <p>Cantidad: {{ $item->cantidad }}</p>
                                    <p>Subtotal: ${{ number_format($item->precio * $item->cantidad, 2) }}</p>
                                </div>
                                <form method="POST" action="/carrito/eliminar">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $item->moto_id }}">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3>Total: ${{ number_format($total, 2) }}</h3>
            <a href="/Catalogo" class="btn btn-secondary">Continuar comprando</a>
            <a href="/finalizarCompra" class="btn btn-success">Proceder al pago</a>
        @else
            <p>Tu carrito está vacío. <a href="/Catalogo">Ir al catálogo</a></p>
        @endif
    </div>
    @endsection
</html>