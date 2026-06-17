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
                            <td class="target-container" style="min-width: 180px;">
                                <div class="d-flex align-items-center justify-content-between view-mode">
                                    <span class="fw-bold text-success fs-5">
                                        ${{ number_format($moto->precio, 2, ',', '.') }}
                                    </span>
                                    <button type="button" class="btn btn-sm btn-link text-decoration-none p-0 ms-2" onclick="activarEdicionPrecio(this)">✏️</button>
                                </div>
                                <form action="{{ route('admin.motos.precio', $moto->id) }}" method="POST" class="edit-mode d-none m-0">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="precio" class="form-control input-precio" step="0.01" min="0" value="{{ $moto->precio }}" required>
                                    </div>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.65rem;">Presioná <span class="fw-bold">Enter</span> para guardar</small>
                                </form>
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
                                <div class="d-flex justify-content-center gap-2">
                                    @if($moto->stock > 0)
                                        <button type="button" class="btn btn-sm btn-success fw-bold px-2 d-flex align-items-center gap-1" 
                                                data-bs-toggle="modal" data-bs-target="#modalVentaFisica"
                                                data-id="{{ $moto->id }}" data-nombre="{{ $moto->nombre }}" data-precio="{{ $moto->precio }}">
                                            💵 Vender
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-secondary fw-bold px-2" disabled>Sin Stock</button>
                                    @endif

                                    <form action="{{ route('admin.motos.destroy', $moto->id) }}" method="POST" class="m-0" onsubmit="return confirm('¿Seguro querés eliminar esta moto del catálogo permanente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                    </form>
                                </div>
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
<div class="modal fade" id="modalVentaFisica" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.motos.vender') }}" method="POST" class="modal-content text-dark">
            @csrf
            <input type="hidden" name="moto_id" id="modalVentaMotoId">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">💵 Facturar Venta Presencial (Mostrador)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="p-3 bg-white border rounded mb-4 shadow-sm">
                    <p class="mb-1 text-muted small text-uppercase fw-bold">Unidad Seleccionada</p>
                    <h4 class="text-dark mb-2" id="modalVentaNombreLabel">--</h4>
                    <p class="mb-0 fs-5 fw-bold text-success">Precio de Salón: $<span id="modalVentaPrecioLabel">0.00</span></p>
                </div>

                <h5 class="mb-3 fw-bold border-bottom pb-1 text-secondary">Datos de Facturación del Cliente</h5>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nombre Completo del Comprador</label>
                    <input type="text" name="titular_pago" class="form-control" placeholder="Ej: Juan Pérez" required>
                </div>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label small fw-bold">DNI del Comprador</label>
                        <input type="number" name="dni_pagador" class="form-control" placeholder="Sin puntos ni guiones" required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label small fw-bold">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control fw-bold text-center" value="1" min="1" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success px-4 fw-bold">Cerrar Venta Física</button>
            </div>
        </form>
    </div>
</div>
<script>
function activarEdicionPrecio(boton) {
    const contenedor = boton.closest('.target-container');
    const modoVista = contenedor.querySelector('.view-mode');
    const modoEdicion = contenedor.querySelector('.edit-mode');
    const input = modoEdicion.querySelector('.input-precio');

    modoVista.classList.add('d-none');
    modoEdicion.classList.remove('d-none');
    input.focus();

    input.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modoVista.classList.remove('d-none');
            modoEdicion.classList.add('d-none');
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const modalVenta = document.getElementById('modalVentaFisica');
    if (modalVenta) {
        modalVenta.addEventListener('show.bs.modal', function (event) {
            const botonDisparador = event.relatedTarget;
            const id = botonDisparador.getAttribute('data-id');
            const nombre = botonDisparador.getAttribute('data-nombre');
            const precio = parseFloat(botonDisparador.getAttribute('data-precio'));

            document.getElementById('modalVentaMotoId').value = id;
            document.getElementById('modalVentaNombreLabel').textContent = nombre;
            document.getElementById('modalVentaPrecioLabel').textContent = precio.toLocaleString('es-AR', { minimumFractionDigits: 2 });
        });
    }
});
</script>
@endsection
