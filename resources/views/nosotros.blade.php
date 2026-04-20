<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')

    <main class="container my-5">
    <!-- Sección: Quiénes Somos -->
    <section class="text-center py-5">
        <h1 class="display-1 fw-bold text-primary">Quiénes Somos</h1>
        <p class="lead fs-4 text-muted">Pasión por las dos ruedas y compromiso con tu seguridad.</p>
    </section>

    <hr class="my-5">

    <!-- Sección: Por qué elegirnos -->
    <section class="row align-items-center py-4">
        <div class="col-md-6">
            <h2 class="display-5 fw-semibold mb-4">¿Por qué elegirnos?</h2>
            <ul class="list-unstyled fs-5">
                <li class="mb-3">✅ <strong>Calidad Garantizada:</strong> Solo trabajamos con marcas líderes.</li>
                <li class="mb-3">✅ <strong>Asesoramiento Real:</strong> Somos motociclistas hablando con motociclistas.</li>
                <li class="mb-3">✅ <strong>Tu Seguridad es Prioridad:</strong> El Rider Kit es nuestra firma de confianza.</li>
            </ul>
        </div>
        <div class="col-md-6 text-center">
            <!-- Podés poner una imagen de tu local o una moto aquí -->
            <div class="bg-light p-5 rounded-4 shadow-sm">
                <p class="fst-italic text-secondary">"No solo vendemos motos, creamos nuevos riders."</p>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <!-- Sección: Cómo llegamos aquí y Cards de Equipo -->
    <section class="py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-semibold">Cómo llegamos aquí</h2>
            <p class="fs-5 text-muted">Nuestra historia comenzó con un garaje y un sueño compartido.</p>
        </div>

        <div class="container g-4 justify-content-evenly d-flex align-items-center">

                <div class="card" style="width: 18rem; height: 18rem;">
                    <img src="/img/joako.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Fundador" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title h4">Nombre de tu Socio</h3>
                        <p class="text-primary fw-bold">Co-Fundador</p>
                        <p class="card-text text-muted small">Contá brevemente la experiencia de tu compañero o su aporte clave.</p>
                    </div>
                </div>

                <div class="card" style="width: 18rem; height: 18rem;">
                    <img src="/img/fede.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Fundador" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title h4">Tu Nombre</h3>
                        <p class="text-primary fw-bold">Co-Fundador</p>
                        <p class="card-text text-muted small">Breve descripción de tu rol y qué te apasiona de este mundo.</p>
                    </div>
                </div>

        </div>
    </section>
</main>

    @endsection
</html>