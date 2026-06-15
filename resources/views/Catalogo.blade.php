@extends('layout.esqueleto')

@section('title', 'Catálogo')

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
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($item->imagen ?? 'img/default-moto.jpg') }}" class="card-img-top" alt="Moto {{ $item->nombre }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->nombre }}</h5>
                        <p class="card-text flex-grow-1 text-muted">{{ $item->descripcion }}.</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold fs-5 text-dark">Precio: ${{ number_format($item->precio, 2, ',', '.') }}</span>
                            <span class="badge {{ $item->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->stock > 0 ? 'Stock: ' . $item->stock : 'Sin Stock' }}
                            </span>
                        </div>
                        
                        <form method="POST" action="/carrito/agregar" class="w-100">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            
                            @if($item->stock > 0)
                                <button type="submit" class="btn btn-dark w-100">Agregar al carrito</button>
                            @else
                                <button type="button" class="btn btn-secondary w-100" disabled>No disponible</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($motos->isEmpty())
        <div class="alert alert-warning text-center mt-4">
            No hay motos disponibles para la marca seleccionada o criterios de búsqueda.
        </div>
    @endif

    <div class="d-flex justify-content-center mt-5">
        {{ $motos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
