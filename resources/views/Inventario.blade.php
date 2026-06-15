@extends('layout.dashboard-esqueleto')

@section('title', 'Gestión de Inventario - Motos')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1><b>Control de Inventario (Motos)</b></h1>
            <p class="text-muted mb-0">Alta, baja y modificación rápida de stock en el salón comercial.</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAltaMoto">
            ➕ Agregar Nueva Moto
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Modelo / Nombre</th>
                        <th>Precio Unitario</th>
                        <th class="text-center">Stock Actual</th>
                        <th class="text-center" style="width: 35%;">Ajustar Stock Físico (Salón)</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($motos as $moto)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $moto->modelo }}</div>
                                <small class="text-muted">{{ $moto->nombre }}</small>
                            </td>
                            <td class="fw-semibold text-secondary">
                                ${{ number_format($moto->precio, 2, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge fs-6 {{ $moto->stock == 0 ? 'bg-danger' : ($moto->stock <= 3 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $moto->stock }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.motos.stock', $moto->id) }}" method="POST" class="d-flex gap-2 justify-content-center align-items-center m-0">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cantidad" class="form-control form-control-sm" style="width: 70px;" min="1" value="1" required>
                                    <select name="operacion" class="form-select form-select-sm" style="width: 110px;">
                                        <option value="sumar">Ingreso (+)</option>
                                        <option value="restar">Egreso (-)</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-dark px-3">Aplicar</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.motos.destroy', $moto->id) }}" method="POST" onsubmit="return confirm('¿Seguro querés eliminar esta moto del catálogo permanente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">✕ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $motos->links('pagination::bootstrap-5') }}
    </div>
</div>

<div class="modal fade" id="modalAltaMoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.motos.store') }}" method="POST" class="modal-content text-dark">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">📦 Registrar Alta de Unidad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Marca del Fabricante</label>
                        <input type="text" name="marca" class="form-control" placeholder="Ej: Honda, Yamaha, Motomel" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Nombre / Modelo de Unidad</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Wave 110S, Tornado" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Precio de Venta ($)</label>
                        <input type="number" name="precio" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Stock Físico Inicial</label>
                        <input type="number" name="stock" class="form-control" min="0" value="1" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Ficha Técnica / Descripción Comercial</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles de la moto..."></textarea>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary px-4">Guardar en Sistema</button>
            </div>
        </form>
    </div>
</div>
@endsection
