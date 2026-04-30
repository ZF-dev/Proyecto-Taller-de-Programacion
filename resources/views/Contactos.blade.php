<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')

    <main class="container my-5">
    <div class="row g-5">
        <!-- Columna Izquierda: Información Institucional -->
        <div class="col-lg-5">
            <h1 class="display-4 fw-bold text-primary mb-4">Contactanos</h1>
            <p class="lead text-muted mb-5">Estamos para asesorarte en la compra de tu próxima unidad. Elegí el medio que te resulte más cómodo.</p>

            <div class="card border-0 bg-light p-4 shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Información Institucional</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <strong>Titular:</strong> Joaquín "Joako" G. & Federico "Fede" R.
                    </li>
                    <li class="mb-3">
                        <strong>Razón Social:</strong> Only Motos S.R.L.
                    </li>
                    <li class="mb-3">
                        <strong>Domicilio Legal:</strong> Av. Libertad 1234, Ciudad de Corrientes, Argentina.
                    </li>
                    <li class="mb-3">
                        <strong>Teléfonos:</strong> +54 (379) 412-3456 / 478-9012
                    </li>
                    <li>
                        <strong>Email:</strong> ventas@onlymotos.com.ar
                    </li>
                </ul>
            </div>

        </div>

        <!-- Columna Derecha: Formulario de Contacto (Cuestionario) -->
        <div class="col-lg-7">
            <div class="card shadow border-0 p-4 p-md-5">
                <h3 class="fw-bold mb-4">Envianos tu consulta</h3>
                <form>
                    @csrf {{-- Importante para Laravel --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label small fw-bold">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="col-md-12">
                            <label for="telefono" class="form-label small fw-bold">Teléfono de Contacto</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Cod. área + número">
                        </div>
                        <div class="col-md-12">
                            <label for="motivo" class="form-label small fw-bold">Motivo de la consulta</label>
                            <select class="form-select" id="motivo" name="motivo">
                                <option selected>Consulta General</option>
                                <option value="1">Cotización de Unidad</option>
                                <option value="2">Servicio Postventa / Garantía</option>
                                <option value="3">Repuestos y Accesorios</option>
                                <option value="4">Plan de Financiación</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="mensaje" class="form-label small fw-bold">Tu mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="¿En qué podemos ayudarte?" required></textarea>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="button" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm" onclick="window.location.href='/exito-consulta'">ENVIAR CONSULTA</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


    @endsection
</html>