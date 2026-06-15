@extends('layout.dashboard-esqueleto')

@section('contenido')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-9 col-lg-10 p-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h2 class="h3 mb-0">Tablero de Control Operativo</h2>
                <span class="badge bg-success p-2 fs-6 shadow-sm">🟢 {{ $usuariosOnline }} En Línea Ahora</span>
            </div>

            <h5 class="text-secondary mb-3">Métricas de Caja e Ingresos</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <small class="text-muted text-uppercase font-weight-bold">Ingreso del Mes Actual</small>
                        <h3 class="text-primary my-2">${{ number_format($ventasMes, 2, ',', '.') }}</h3>
                        <div class="border-top pt-2">
                            <small class="text-muted d-block">Media de 3 meses: ${{ number_format($metaAutomatica, 2, ',', '.') }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3 text-white {{ $balanceMes >= 0 ? 'bg-success' : 'bg-danger' }}">
                        <small class="text-uppercase font-weight-bold">Balance vs Tendencia anterior</small>
                        <h3 class="my-2">${{ number_format($balanceMes, 2, ',', '.') }}</h3>
                        <div class="border-top pt-2">
                            <small>{{ $balanceMes >= 0 ? '📈 Superando la media previa' : '📉 Por debajo de la media previa' }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <small class="text-muted text-uppercase font-weight-bold">Facturación Anual Acumulada</small>
                        <h3 class="text-dark my-2">${{ number_format($ventasAnio, 2, ',', '.') }}</h3>
                        <div class="border-top pt-2">
                            <small class="text-muted">Ciclo Fiscal {{ Carbon\Carbon::now()->year }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="text-secondary mb-3">Mercadería y Valor de Stock</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <small class="text-muted text-uppercase font-weight-bold">Capital Inmovilizado</small>
                        <h4 class="text-secondary my-2">${{ number_format($valorInventario, 2, ',', '.') }}</h4>
                        <small class="text-muted">Modelos únicos: {{ $totalMotos }}</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <small class="text-muted text-uppercase font-weight-bold">Stock Físico Total</small>
                        <h4 class="text-dark my-2">{{ $stockTotal }} Unidades</h4>
                        <small class="text-muted">Disponibles en el salón</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-primary text-white">
                        <small class="text-uppercase font-weight-bold"> Moto estrella </small>
                        @if($motoEstrella)
                            <h4 class="my-2">{{ $motoEstrella->nombre }}</h4>
                            <small>Quedan solo <strong>{{ $motoEstrella->stock }} unidades</strong> en stock.</small>
                        @else
                            <h4 class="my-2">Sin Datos</h4>
                            <small>No hay vehículos registrados.</small>
                        @endif
                    </div>
                </div>
            </div>

            <h5 class="text-secondary mb-3">Auditoría de Usuarios</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3 text-center">
                        <h2 class="display-5 text-dark mb-1 font-weight-bold">{{ $totalUsuarios }}</h2>
                        <span class="text-muted text-uppercase small">Usuarios Totales</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3 text-center">
                        <h2 class="display-5 mb-1 font-weight-bold" style="color: #9101ff;">{{ $totalCompradores }}</h2>
                        <span class="text-muted text-uppercase small">Usuarios compradores</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
