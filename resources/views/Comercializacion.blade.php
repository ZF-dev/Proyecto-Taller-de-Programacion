<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')

    <main class="container my-5">
    <!-- Encabezado -->
    <section class="text-center py-5 bg-dark text-white rounded-5 mb-5 shadow">
        <h1 class="display-3 fw-bold">Comercialización</h1>
        <p class="lead">Todo lo que necesitás saber para subirte a tu próxima moto de forma fácil y segura.</p>
    </section>

    <div class="row g-5">
        <!-- 1. Formas de Pago -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 text-primary mb-3">
                        <i class="bi bi-credit-card-2-back"></i>
                    </div>
                    <h3 class="fw-bold">Formas de Pago</h3>
                    <p class="text-muted small mb-4">Adaptamos nuestras opciones a tu bolsillo.</p>
                    <ul class="list-unstyled text-start">
                        <li class="mb-2">💵 <strong>Efectivo/Transferencia:</strong> Consultá descuentos especiales por pago contado.</li>
                        <li class="mb-2">💳 <strong>Tarjetas de Crédito:</strong> Planes Ahora 12 y Ahora 18 (sujeto a disponibilidad).</li>
                        <li class="mb-2">🏦 <strong>Créditos Prendarios:</strong> Financiación bancaria solo con DNI y aprobación inmediata.</li>
                        <li class="mb-2">🔄 <strong>Permutas:</strong> Tomamos tu moto usada como parte de pago (sujeto a peritaje).</li>
                    </ul> 
                </div>
            </div>
        </div>

        <!-- 2. Tipos de Entrega -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 text-primary mb-3">
                        <i class="bi bi-shop"></i>
                    </div>
                    <h3 class="fw-bold">Tipos de Entrega</h3>
                    <p class="text-muted small mb-4">Rapidez y transparencia en el proceso.</p>
                    <ul class="list-unstyled text-start">
                        <li class="mb-2">🏁 <strong>Entrega Inmediata:</strong> Contamos con stock propio para que te la lleves en el día.</li>
                        <li class="mb-2">📑 <strong>Entrega Programada:</strong> Si buscás un color específico, la reservamos y te avisamos al arribo.</li>
                        <li class="mb-2">🛡️ <strong>Rider Ready:</strong> Todas las motos se entregan con service pre-entrega y control de seguridad realizado.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 3. Formas de Envío -->
        <div class="col-md-4">
    <div class="card h-100 border-0 shadow-sm">
        <div class="card-body text-center">
            <div class="display-4 text-primary mb-3">
                <i class="bi bi-truck"></i>
            </div>
            <h3 class="fw-bold">Opciones de Envío</h3>
            <p class="text-muted small mb-4">Llegamos a todo el país con logística propia y asociada.</p>
            <ul class="list-unstyled text-start">
                <li>
                    <br><strong>Envío Normal:</strong> Entrega de 5 a 7 días hábiles. Ideal para quienes no tienen prisa y buscan el costo más bajo.
                </li>
                <li>
                    <br><strong>Envío Express:</strong> Entrega prioritaria en 24/48hs (disponible para zonas seleccionadas y CABA/GBA).
                </li>
                <li>
                    <br><strong>Envío Pro-Box (Larga Distancia):</strong> La moto viaja dentro de una jaula de madera (huacal) sellada, protegida de cualquier golpe o clima.
                </li>
                <li>
                    <i class="bi bi-info-circle text-primary"></i> <small class="text-muted">Todos los envíos incluyen seguro por el valor total de la unidad.</small>
                </li>
            </ul>
        </div>
    </div>
</div>
    </div>

    <!-- Sección de Información Útil-->
    <section class="mt-5 p-4 bg-light rounded-4">
        <h2 class="text-center fw-bold mb-4">Información Útil para el Comprador</h2>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold text-primary">¿Qué documentación necesito?</h5>
                <p class="small text-muted">Para la compra solo necesitás tu DNI vigente. Nosotros nos encargamos de toda la gestión de patentamiento y formularios ante el Registro del Automotor.</p>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold text-primary">¿La moto sale con seguro?</h5>
                <p class="small text-muted">¡Sí! En Only Motos trabajamos con las principales aseguradoras. No permitimos que ninguna unidad salga a la calle sin, al menos, el seguro de Responsabilidad Civil obligatorio.</p>
            </div>
            <div class="col-md-6 mt-3">
                <h5 class="fw-bold text-primary">Garantía de Fábrica</h5>
                <p class="small text-muted">Todas nuestras motos 0km cuentan con garantía oficial de la marca, siempre y cuando los servicios de mantenimiento se realicen en talleres autorizados.</p>
            </div>
            <div class="col-md-6 mt-3">
                <h5 class="fw-bold text-primary">¿Puedo probar la moto?</h5>
                <p class="small text-muted">Disponemos de unidades de Test Ride para modelos seleccionados. Consultá con nuestros asesores para agendar tu prueba de manejo.</p>
            </div>
        </div>
    </section>

    <!-- Botón de Acción -->
    <div class="text-center mt-5">
        <a href="/Catalogo" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">VER CATÁLOGO DISPONIBLE</a>
        <p class="mt-3 text-muted">¿Tenés dudas específicas? <a href="/Contactos" class="text-decoration-none">Contactate con un asesor</a></p>
    </div>
</main>

    @endsection
</html>