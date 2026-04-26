<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('title', 'Catalogo')

    @section('contenido')
    <div class="container mt-5">
        <h1 class="mb-4">Catálogo de Motos</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach (config('productos') as $item)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset($item['imagen']) }}" class="card-img-top" alt="Moto {{ $item['nombre']}}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item['nombre']}}</h5>
                            <p class="card-text flex-grow-1">{{ $item['descripcion']}}.</p>
                            <p class="fw-bold">Precio: ${{ number_format($item['precio'],2)}}</p>
                            <form method="POST" action="/carrito/agregar" style="display: inline;">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $item['id'] }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn btn-dark w-100">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection
</html>

            

