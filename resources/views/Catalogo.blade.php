<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('title', 'Catalogo')

    @section('contenido')
    <div class="container mt-5">
        <h1 class="mb-4">Catálogo de Motos</h1>
        
        <div class="mb-4">
            <form method="GET" action="/Catalogo" class="d-flex gap-2 align-items-end">
                <div class="flex-grow-1">
                    <label for="marcaFilter" class="form-label">Filtrar por marca:</label>
                    <select class="form-select" id="marcaFilter" name="marca">
                        <option value="">-- Todas las marcas --</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ $marcaSeleccionada == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Filtrar</button>
                <a href="/Catalogo" class="btn btn-secondary">Limpiar</a>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($motos as $item)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset($item->imagen) }}" class="card-img-top" alt="Moto {{ $item->nombre}}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->nombre}}</h5>
                            <p class="card-text flex-grow-1">{{ $item->descripcion}}.</p>
                            <p class="fw-bold">Precio: ${{ number_format($item->precio,2)}}</p>
                            <form method="POST" action="/carrito/agregar" style="display: inline;">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $item->id }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn btn-dark w-100">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($motos->isEmpty())
            <div class="alert alert-warning text-center mt-4">
                No hay motos para la marca seleccionada.
            </div>
        @endif

        <div class="d-flex justify-content-center mt-5">
            {{ $motos->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endsection
</html>

            

