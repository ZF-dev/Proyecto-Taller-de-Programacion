@extends('layout.dashboard-esqueleto')

@section('title', 'Administración de Usuarios y Personal')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1><b>Control de Usuarios y Roles</b></h1>
            <p class="text-muted mb-0">Gestión de credenciales de clientes, empleados y administradores del sistema.</p>
        </div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalAltaUsuario">
            👤 Crear Nuevo Usuario / Personal
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
                        <th>Nombre y Apellido</th>
                        <th>Correo Electrónico</th>
                        <th class="text-center">Rango Actual</th>
                        <th class="text-center" style="width: 30%;">Modificar Jerarquía</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td style="max-width: 180px;">
                                <div class="fw-bold text-dark text-truncate" title="{{ $user->name }}">{{ $user->name }}</div>
                                <small class="text-secondary font-monospace d-block">ID de Registro: #{{ $user->id }}</small>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a>
                            </td>
                            <td class="text-center">
                                <span class="badge px-3 py-2 text-uppercase" style="background-color: {{ $user->role === 'admin' ? '#9101ff' : '#6c757d' }}; color: white;">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.usuarios.rol', $user->id) }}" method="POST" class="d-flex gap-2 justify-content-center align-items-center m-0">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="form-select form-select-sm" style="width: 150px;">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User (Cliente)</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin (Personal)</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-dark px-2">Cambiar</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Seguro querés dar de baja definitiva a este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none p-0">✕ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- MODAL: Formulario de Registro de Usuario -->
<div class="modal fade" id="modalAltaUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.usuarios.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Registrar Alta de Cuenta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nombre Completo</label>
                    <input type="text" name="name" class="form-control" placeholder="Ej: Carlos Gómez" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Correo Electrónico Corporativo / Particular</label>
                    <input type="email" name="email" class="form-control" placeholder="nombre@onlymotos.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">DNI</label>
                    <input type="text" name="dni" class="form-control" placeholder="Ej: 12345678" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Contraseña de Acceso (Mínimo 6 caracteres)</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Jerarquía Operativa (Rol)</label>
                    <select name="role" class="form-select" required>
                        <option value="user" selected>User (Cliente General / Común)</option>
                        <option value="admin">Admin (Socio / Personal de Ventas / Empleado)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-dark">Dar de Alta</button>
            </div>
        </form>
    </div>
</div>
@endsection
