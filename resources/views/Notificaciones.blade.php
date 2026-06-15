@extends('layout.dashboard-esqueleto')

@section('title', 'Panel de Notificaciones y Consultas')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><b>Bandeja de Alertas y Consultas</b></h1>
        <div class="mb-4 d-flex gap-2">
            <a href="{{ route('notificaciones.index') }}" class="btn btn-sm {{ $tipoActual === 'todas' ? 'btn-dark' : 'btn-outline-dark' }}">Ver Todas</a>
            <a href="{{ route('notificaciones.index', ['tipo' => 'consultas']) }}" class="btn btn-sm {{ $tipoActual === 'consultas' ? 'btn-primary' : 'btn-outline-primary' }}">Solo Consultas Clientes</a>
            <a href="{{ route('notificaciones.index', ['tipo' => 'avisos']) }}" class="btn btn-sm {{ $tipoActual === 'avisos' ? 'btn-warning' : 'btn-outline-warning' }}">Solo Avisos de Sistema</a>
        </div>
        <span class="badge bg-dark fs-6">
            Pendientes: {{ $notificaciones->where('leido', false)->count() }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if($notificaciones->isEmpty())
        <div class="text-center p-5 bg-light rounded border">
            <p class="text-muted fs-5 mb-0">No hay notificaciones ni consultas registradas en este momento.</p>
        </div>
    @else
        <!-- Contenedor del Acordeón Dinámico de Bootstrap -->
        <div class="accordion shadow-sm" id="accordionNotificaciones">
            @foreach($notificaciones as $item)
                <div class="accordion-item border-{{ $item->color }} mb-2 border-start border-4 rounded-0 shadow-sm">
                    
                    <!-- Encabezado de la Notificación -->
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed d-flex align-items-center justify-content-between gap-3 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}">
                            <div class="flex-grow-1">
                                <!-- Cambia el estilo del texto si está leído o no -->
                                <span class="{{ $item->leido ? 'text-muted text-decoration-line-through' : 'fw-bold text-dark' }}">
                                    {{ $item->mensaje }}
                                </span>
                                <small class="text-muted d-block mt-1">
                                    Recibido: {{ $item->created_at->diffForHumans() }}
                                </small>
                            </div>
                            
                            <div class="me-3">
                                @if($item->leido)
                                    <span class="badge bg-secondary">Respondida / Leída</span>
                                @else
                                    <span class="badge bg-{{ $item->color == 'info' ? 'primary' : $item->color }}">Nueva</span>
                                @endif
                            </div>
                        </button>
                    </h2>

                    <!-- Cuerpo Desplegable (Detalle del JSON) -->
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordionNotificaciones">
                        <div class="accordion-body bg-light">
                            
                            @if($item->consulta)
                                <div class="p-3 bg-white border rounded mb-3">
                                    <h5 class="border-bottom pb-2 text-primary mb-3">Ficha de la Consulta Comercial</h5>
                                    <div class="row g-2 small">
                                        <div class="col-md-4"><strong>Nombre del Cliente:</strong> {{ $item->consulta['nombre'] }}</div>
                                        <div class="col-md-4"><strong>Email de Contacto:</strong> <a href="mailto:{{ $item->consulta['email'] }}">{{ $item->consulta['email'] }}</a></div>
                                        <div class="col-md-4"><strong>Teléfono:</strong> {{ $item->consulta['telefono'] }}</div>
                                    </div>
                                    <div class="mt-4 p-3 bg-light rounded italic border-start border-primary border-3">
                                        <p class="mb-0 fw-semibold text-secondary">Mensaje enviado:</p>
                                        <p class="mb-0 text-dark mt-1" style="white-space: pre-line;">"{{ $item->consulta['texto'] }}"</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted small">Esta notificación no incluye un bloque de datos adjuntos.</p>
                            @endif

                            <!-- Acciones de Gestión -->
                            <div class="d-flex justify-content-end align-items-center mt-3 gap-2">
                                @if(!$item->leido)
                                    <form action="{{ route('notificaciones.leer', $item->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success px-3">
                                            ✔ Marcar como Respondida
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small italic">
                                        Archivada. Se eliminará del sistema el: {{ $item->created_at->addDays(15)->format('d/m/Y') }} (Prunable)
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación de Bootstrap 5 -->
        <div class="d-flex justify-content-center mt-4">
            {{ $notificaciones->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
