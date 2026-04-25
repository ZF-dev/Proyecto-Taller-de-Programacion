<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')

    <main class="container my-5">
    <!-- Sección: Quiénes Somos -->
    <section class="text-center py-5">
        <h1 class="display-2 fw-extrabold text-dark">ONLY<span class="text-primary">MOTOS</span></h1>
        <p class="lead fs-3 text-muted mx-auto" style="max-width: 800px;">
            Más que una agencia, somos el punto de partida de tu próxima aventura. 
            Pasión por las dos ruedas y compromiso total con tu seguridad.
        </p>
    </section>

    <hr class="my-5 opacity-25">

    <!-- Sección: Por qué elegirnos -->
    <section class="row align-items-center py-4">
        <div class="col-md-6">
            <h2 class="display-5 fw-bold mb-4">¿Por qué Only Motos?</h2>
            <div class="d-flex mb-4">
                <div class="text-primary me-3"><i class="bi bi-check-circle-fill fs-2"></i></div>
                <div>
                    <h4 class="fw-bold">Calidad Garantizada</h4>
                    <p class="text-muted">No vendemos nada que no usaríamos nosotros. Trabajamos solo con marcas que respaldan cada kilómetro.</p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <div class="text-primary me-3"><i class="bi bi-person-check-fill fs-2"></i></div>
                <div>
                    <h4 class="fw-bold">Asesoramiento Real</h4>
                    <p class="text-muted">¿Primera moto? ¿Salto de cilindrada? Te ayudamos a elegir la máquina que realmente necesitás, no la más cara.</p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <div class="text-primary me-3"><i class="bi bi-shield-lock-fill fs-2"></i></div>
                <div>
                    <h4 class="fw-bold">Rider Kit Incluido</h4>
                    <p class="text-muted">Tu seguridad no es opcional. Nuestra firma es que salgas equipado y protegido desde el primer día.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="bg-dark text-white p-5 rounded-5 shadow-lg transform-hover" style="transition: 0.3s;">
                <h3 class="display-6 fw-italic font-monospace">"No solo vendemos motos, <br> <span class="text-primary">formamos nuevos riders.</span>"</h3>
            </div>
        </div>
    </section>

    <hr class="my-5 opacity-25">

    <!-- Sección: Historia y Equipo -->
    <section class="py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Detrás del Casco</h2>
            <p class="fs-5 text-muted">Nuestra historia comenzó con un garaje, herramientas y un sueño compartido de libertad.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Socio 1: Joako -->
            <div class="col-12 col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="/img/joako.png" class="card-img-top rounded-circle mx-auto mt-3 shadow" alt="Joaquín" style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #0d6efd;">
                    <div class="card-body">
                        <h3 class="card-title h4 fw-bold">Joaquín</h3>
                        <p class="text-primary fw-bold text-uppercase small tracking-widest">Co-Fundador & Especialista Técnico</p>
                        <p class="card-text text-muted">Encargado de que cada unidad supere los estándares más exigentes. Su ojo clínico no deja pasar un solo detalle mecánico.</p>
                    </div>
                </div>
            </div>

            <!-- Socio 2: Fede -->
            <div class="col-12 col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="/img/fede.png" class="card-img-top rounded-circle mx-auto mt-3 shadow" alt="Federico" style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #0d6efd;">
                    <div class="card-body">
                        <h3 class="card-title h4 fw-bold">Federico</h3>
                        <p class="text-primary fw-bold text-uppercase small tracking-widest">Co-Fundador & Experiencia Rider</p>
                        <p class="card-text text-muted">Apasionado por las rutas y el equipamiento. Se asegura de que tu experiencia de compra sea tan emocionante como el primer arranque.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center mt-4">
            <div class="text-center mt-5 mb-4">
                <h3 class="h4 fw-bold text-secondary text-uppercase">Nuestro Staff Especializado</h3>
            </div>

            <!-- Empleada 1: Sofía -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center pb-3">
                    <img src="/img/sofia.png" class="card-img-top rounded-circle mx-auto mt-4 shadow-sm" alt="Ventas" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Sofía Morales</h5>
                        <p class="text-primary small fw-bold mb-2">Asesora de Ventas & Indumentaria</p>
                        <p class="card-text text-muted small">Experta en seguridad pasiva. Te ayuda a elegir el casco y la campera ideal combinando estilo y protección máxima.</p>
                    </div>
                </div>
            </div>

            <!-- Empleado 2: Lucas -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center pb-3">
                    <img src="/img/lucas.png" class="card-img-top rounded-circle mx-auto mt-4 shadow-sm" alt="Mecánico" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Lucas Herrera</h5>
                        <p class="text-primary small fw-bold mb-2">Técnico de Service</p>
                        <p class="card-text text-muted small">El "doctor" del taller. Con años de experiencia en motores de alta cilindrada, se asegura de que cada moto salga en estado impecable.</p>
                    </div>
                </div>
            </div>

            <!-- Empleada 3: Valentina -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center pb-3">
                    <img src="/img/valentina.png" class="card-img-top rounded-circle mx-auto mt-4 shadow-sm" alt="Gestoría" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Valentina Ruiz</h5>
                        <p class="text-primary small fw-bold mb-2">Gestión & Trámites</p>
                        <p class="card-text text-muted small">La que hace que todo fluya. Se encarga de patentamientos y seguros para que vos solo tengas que preocuparte por subirte y arrancar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

    @endsection
</html>