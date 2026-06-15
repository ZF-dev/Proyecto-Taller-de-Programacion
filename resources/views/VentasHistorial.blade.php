@extends('layout.dashboard-esqueleto')

@section('title', 'Historial de Ventas Comerciales')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h1><b>Historial de Facturación y Ventas</b></h1>
        <p class="text-muted">Registro completo de operaciones comerciales realizadas a través de la web y en el local.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha / Ticket</th>
                        <th>Cliente / Comprador</th>
                        <th>Método de Pago</th>
                        <th>Detalle de Unidades Entregadas</th>
                        <th class="text-end">Total Facturado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $factura)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">Ticket #{{ $factura->id }}</div>
                                <small class="text-muted">{{ $factura->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $factura->titular_pago ?? 'Cliente General' }}</div>
                                <small class="text-secondary">DNI: {{ $factura->dni_pagador ?? 'N/D' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase px-2 py-1">
                                    {{ $factura->metodo_pago }}
                                </span>
                                @if($factura->tarjeta_ultimos_cuatro)
                                    <small class="text-muted d-block font-monospace">💳 ****{{ $factura->tarjeta_ultimos_cuatro }}</small>
                                @endif
                                @if($factura->comprobante_transferencia)
                                    <small class="text-muted d-block font-monospace">🏦 Comp: {{ $factura->comprobante_transferencia }}</small>
                                @endif
                            </td>
                            <td class="bg-light small">
                                <ul class="list-unstyled mb-0">
                                    @foreach($factura->items as $item)
                                        <li>
                                            🏍️ <strong>{{ $item->moto_modelo_historico }}</strong> 
                                            <span class="text-muted">x{{ $item->cantidad }}</span> 
                                            <span class="text-secondary">(${{ number_format($item->precio_unitario, 2, ',', '.') }} c/u)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-end fw-bold fs-5 text-success">
                                ${{ number_format($factura->total, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $ventas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
