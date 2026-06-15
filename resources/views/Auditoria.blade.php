@extends('layout.dashboard-esqueleto')

@section('title', 'Registro de Auditoría Sistemática')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h1><b>Registro de Auditoría e Historial</b></h1>
        <p class="text-muted">Libro de actas digital permanente. Registra de forma inalterable las acciones críticas sobre el inventario.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 15%;">Fecha y Hora</th>
                        <th style="width: 15%;">Responsable</th>
                        <th style="width: 15%;">Acción</th>
                        <th style="width: 10%;">Módulo</th>
                        <th style="width: 35%;">Detalle de Modificación (JSON Map)</th>
                        <th style="width: 10%;">Dirección IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auditorias as $log)
                        <tr>
                            <td class="small fw-semibold text-secondary">
                                {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border p-2 w-100 text-start">👤 {{ $log->user->name }}</span>
                            </td>
                            
                            <!-- Renderizado dinámico de colores de Bootstrap según la criticidad de la acción -->
                            <td>
                                @if(in_array($log->accion, ['Alta de Producto', 'Alta de Usuario', 'Alta de Administrador']))
                                    <span class="badge bg-success px-2 py-1"> {{ $log->accion }}</span>
                                @elseif(in_array($log->accion, ['Baja de Producto', 'Baja de Usuario', 'Baja de Administrador']))
                                    <span class="badge bg-danger px-2 py-1"> {{ $log->accion }}</span>
                                @elseif($log->accion === 'Modificación de Privilegios (Seguridad)')
                                    <span class="badge bg-dark text-white px-2 py-1"> {{ $log->accion }}</span>
                                @elseif($log->accion === 'Cierre de Venta Comercial')
                                    <span class="badge bg-info text-dark px-2 py-1"> {{ $log->accion }}</span>
                                @else
                                    <span class="badge bg-warning text-dark px-2 py-1"> {{ $log->accion }}</span>
                                @endif
                            </td>
                            
                            <td><code class="text-uppercase font-monospace fw-bold">{{ $log->tabla_afectada }}</code></td>
                            
                            <td class="small bg-light p-2">
                                @php
                                    $detallesArray = is_array($log->detalles) ? $log->detalles : json_decode($log->detalles, true);
                                @endphp
                                
                                <div style="max-height: 120px; overflow-y: auto;">
                                    
                                    @if($log->tabla_afectada === 'ventas')
                                        <strong>Ticket N°:</strong> {{ $detallesArray['venta_id'] ?? 'N/D' }} | 
                                        <strong>Cliente:</strong> {{ $detallesArray['comprador'] ?? 'Cliente General' }}<br>
                                        <span class="text-success fw-bold">
                                            Monto Registrado: ${{ number_format($detallesArray['total'] ?? 0, 2, ',', '.') }}
                                        </span> 
                                        <span class="text-muted">({{ $detallesArray['metodo_pago'] ?? 'efectivo' }})</span>

                                    @elseif($log->accion === 'Modificación de Privilegios (Seguridad)')
                                        <strong>Operación sobre:</strong> {{ $detallesArray['usuario_afectado'] ?? 'N/D' }}<br>
                                        <span class="text-muted">Cambio de Permisos:</span> 
                                        <span class="badge bg-secondary">{{ $detallesArray['rol_anterior'] ?? 'N/D' }}</span> ➔ 
                                        <span class="badge bg-primary">{{ $detallesArray['rol_nuevo'] ?? 'N/D' }}</span>

                                    @elseif(isset($detallesArray['cambios']))
                                        <strong>Unidad:</strong> <span class="text-primary fw-bold">{{ $detallesArray['nombre'] ?? 'N/D' }}</span><br>
                                        @foreach($detallesArray['cambios'] as $campo => $valores)
                                            <div class="ps-2">
                                                <span class="text-capitalize"><strong>{{ $campo }}:</strong></span> 
                                                <span class="text-muted text-decoration-line-through">{{ $valores['antes'] }}</span> ➔ 
                                                <span class="text-dark fw-bold">{{ $valores['despues'] }}</span>
                                            </div>
                                        @endforeach

                                    @else
                                        <strong>Entidad:</strong> 
                                        <span class="text-dark fw-bold">
                                            {{ $detallesArray['nombre'] ?? $detallesArray['usuario_afectado'] ?? $detallesArray['usuario_eliminado'] ?? 'Operación General' }}
                                        </span><br>
                                        <span class="text-muted small">Estructura indexada correctamente en el libro de actas.</span>
                                    @endif

                                </div>
                            </td>

                            <td><span class="text-muted font-monospace small">{{ $log->ip_address ?? '127.0.0.1' }}</span></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación de Bootstrap 5 -->
    <div class="d-flex justify-content-center mt-4">
        {{ $auditorias->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
