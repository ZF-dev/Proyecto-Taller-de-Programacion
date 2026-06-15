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
                            <!-- Si no hay imagen por algún motivo, ponemos una por defecto -->
                            <img src="{{ asset($item->moto->imagen ?? 'img/default-moto.jpg') }}" width="100" height="100" alt="{{ $item->moto->nombre ?? $item->moto_modelo_historico }}" class="me-3" style="object-fit: cover;">
                            
                            <div class="flex-grow-1">
                                <h5>{{ $item->moto->nombre ?? $item->moto_modelo_historico }}</h5>
                                <p class="mb-1">Precio Unitario: ${{ number_format($item->precio_unitario, 2, ',', '.') }}</p>
                                <p class="mb-1">Cantidad: {{ $item->cantidad }}</p>
                                <p class="mb-0 fw-bold">Subtotal: ${{ number_format($item->precio_unitario * $item->cantidad, 2, ',', '.') }}</p>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Total a Pagar: <span class="text-success">${{ number_format($total, 2, ',', '.') }}</span></h3>
        </div>
        <div class="gap-2 d-flex">
            <a href="/Catalogo" class="btn btn-secondary">Continuar comprando</a>
            <!-- Apunta a la pantalla donde el usuario elegirá Tarjeta o Transferencia -->
            <a href="/finalizarCompra" class="btn btn-success">Proceder al pago interactivo</a>
        </div>
    @else
        <div class="text-center p-5 bg-light rounded">
            <p class="fs-5 text-muted">Tu carrito está vacío actualmente.</p>
            <a href="/Catalogo" class="btn btn-primary">Ir al catálogo de motos</a>
        </div>
    @endif
</div>
@endsection

