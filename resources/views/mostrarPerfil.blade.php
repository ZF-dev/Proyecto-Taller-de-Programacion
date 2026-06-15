@extends('layout.esqueleto')

@section('contenido')
<div class="container my-5">
    <div class="row justify-content-center g-4">
        
        <!-- COLUMNA IZQUIERDA: TARJETA DE PERFIL INTERACTIVA -->
        <div class="col-md-6">
            @if(session('success'))
                <div class="alert alert-success py-2 px-3 small shadow-sm mb-3" style="border-radius: 6px;">
                    ✔ {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small shadow-sm mb-3" style="border-radius: 6px;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error) 
                            <li>{{ $error }}</li> 
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h4 class="mb-0">Mi Perfil Personal</h4>
                    <span class="badge bg-secondary mt-2 text-uppercase">{{ $usuario->role }}</span>
                </div>
                
                <div class="card-body p-4">
                    
                    <!-- Campo: Nombre Completo -->
                    <div class="mb-3 border-bottom pb-2 position-relative target-container">
                        <label class="text-muted small d-block">Nombre Completo</label>
                        <div class="d-flex justify-content-between align-items-center view-mode">
                            <strong class="text-dark">{{ $usuario->name }}</strong>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none p-0" onclick="activarEdicion(this)">✏️</button>
                        </div>
                        <form action="{{ route('perfil.actualizar') }}" method="POST" class="edit-mode d-none m-0">
                            @csrf 
                            @method('PATCH')
                            <input type="text" name="name" class="form-control form-control-sm input-editable" value="{{ $usuario->name }}" required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Presioná <span class="fw-bold">Enter</span> para guardar o <span class="fw-bold">Esc</span> para cancelar</small>
                        </form>
                    </div>

                    <!-- Campo: DNI -->
                    <div class="mb-3 border-bottom pb-2 position-relative target-container">
                        <label class="text-muted small d-block">DNI</label>
                        <div class="d-flex justify-content-between align-items-center view-mode">
                            <strong class="text-dark">{{ $usuario->dni ?? 'No especificado' }}</strong>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none p-0" onclick="activarEdicion(this)">✏️</button>
                        </div>
                        <form action="{{ route('perfil.actualizar') }}" method="POST" class="edit-mode d-none m-0">
                            @csrf @method('PATCH')
                            <input type="number" name="dni" class="form-control form-control-sm input-editable" value="{{ $usuario->dni }}" required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Presioná <span class="fw-bold">Enter</span> para guardar o <span class="fw-bold">Esc</span> para cancelar</small>
                        </form>
                    </div>

                    <!-- Campo: Fecha de Nacimiento -->
                    <div class="mb-3 border-bottom pb-2 position-relative target-container">
                        <label class="text-muted small d-block">Fecha de Nacimiento</label>
                        <div class="d-flex justify-content-between align-items-center view-mode">
                            <strong class="text-dark">{{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d/m/Y') }}</strong>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none p-0" onclick="activarEdicion(this)">✏️</button>
                        </div>
                        <form action="{{ route('perfil.actualizar') }}" method="POST" class="edit-mode d-none m-0">
                            @csrf 
                            @method('PATCH')
                            <input type="date" name="fecha_nacimiento" class="form-control form-control-sm input-editable" value="{{ $usuario->fecha_nacimiento }}" required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Presioná <span class="fw-bold">Enter</span> para guardar o <span class="fw-bold">Esc</span> para cancelar</small>
                        </form>
                    </div>

                    <!-- Campo: Correo Electrónico -->
                    <div class="mb-4 border-bottom pb-2 position-relative target-container">
                        <label class="text-muted small d-block">Correo Electrónico</label>
                        <div class="d-flex justify-content-between align-items-center view-mode">
                            <strong class="text-dark">{{ $usuario->email }}</strong>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none p-0" onclick="activarEdicion(this)">✏️</button>
                        </div>
                        <form action="{{ route('perfil.actualizar') }}" method="POST" class="edit-mode d-none m-0">
                            @csrf 
                            @method('PATCH')
                            <input type="email" name="email" class="form-control form-control-sm input-editable" value="{{ $usuario->email }}" required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Presioná <span class="fw-bold">Enter</span> para guardar o <span class="fw-bold">Esc</span> para cancelar</small>
                        </form>
                    </div>

                    <!-- 🔴 BOTÓN DE CERRAR SESIÓN -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-2 fw-bold shadow-sm">
                            <svg xmlns="http://w3.org" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5-.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </form>

                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="/" class="text-muted text-decoration-none small">&larr; Volver al Inicio</a>
            </div>
        </div>

        <!-- COLUMNA DERECHA: DESPLEGABLE INTERACTIVO DE HISTORIAL DE COMPRAS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">📦 Mi Historial de Compras</h5>
                </div>
                <div class="card-body p-3">
                    @if($compras->isEmpty())
                        <p class="text-muted text-center py-4 mb-0">Todavía no realizaste ninguna compra en el sitio.</p>
                    @else
                        <!-- Acordeón interactivo de Bootstrap 5 -->
                        <div class="accordion" id="acordeonCompras">
                            @foreach($compras as $ticket)
                                <div class="accordion-item mb-2 border rounded">
                                    <h2 class="accordion-header" id="heading-{{ $ticket->id }}">
                                        <button class="accordion-button collapsed py-2 px-3 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $ticket->id }}" aria-expanded="false">
                                            <div class="w-100 d-flex justify-content-between align-items-center pe-3 small">
                                                <span><strong>Ticket #{{ $ticket->id }}</strong> ({{ $ticket->created_at->format('d/m/Y') }})</span>
                                                <span class="text-success fw-bold">${{ number_format($ticket->total, 2, ',', '.') }}</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $ticket->id }}" class="accordion-collapse collapse" data-bs-parent="#acordeonCompras">
                                        <div class="accordion-body bg-light py-2 px-3 small">
                                            <p class="mb-1 text-muted">Método de Pago: <strong class="text-uppercase text-dark">{{ $ticket->metodo_pago }}</strong></p>
                                            <hr class="my-1">
                                            <p class="fw-bold mb-1 text-secondary">Motos entregadas:</p>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($ticket->items as $moto)
                                                    <li class="py-1 border-bottom">{{ $moto->moto_modelo_historico }}x{{ $moto->cantidad }}${{ number_format($moto->precio_unitario * $moto->cantidad, 2, ',', '.') }}</li>
                                                 @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- 🔒 CIERRE DE LA COLUMNA DERECHA -->

    </div>
</div>
<!-- 🔒 CIERRES ESTRUCTURALES DEL CONTENEDOR GLOBAL -->

<script>
function activarEdicion(boton) {
    const contenedor = boton.closest('.target-container');
    const modoVista = contenedor.querySelector('.view-mode');
    const modoEdicion = contenedor.querySelector('.edit-mode');
    const input = modoEdicion.querySelector('.input-editable');

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
</script>
@endsection