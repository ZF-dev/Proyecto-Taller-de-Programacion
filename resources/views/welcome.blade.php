<!DOCTYPE html>
<html lang="es">

    @extends('layout.esqueleto')
    
    @section('title', 'E-commerce "Motochorros" (motos robadas)')
    

    @section('contenido')
    <main class="grow-flex-1 mb-3">
        <div id="carruselPrincipal" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores (los puntitos de abajo) -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/img/CarrucelPC.png" class="d-none d-md-block w-100" alt="Banner Motos Desktop" style="max-height: 480px; object-fit: cover;; background-color: #00aff0;">
                    <!-- IMAGEN PARA CELULAR: Se muestra solo en móviles -->
                    <img src="/img/CarrucelM.png" class="d-block d-md-none w-100" style="height: 600px; object-fit: cover;" alt="Banner Motos Movil">
                </div>
                <div class="carousel-item">
                    <img src="/img/Carrucel2PC.png" class="d-none d-md-block w-100" alt="Banner Eslogan Desktop" style="max-height: 480px; object-fit: cover;; background-color: #00aff0;">
                    <img src="/img/Carrucel2M.png" class="d-block d-md-none w-100" style="height: 600px; object-fit: cover;" alt="Banner Eslogan Movil">
                </div>
                <div class="carousel-item">
                    <img src="/img/Carrucel3PC.png" class="d-none d-md-block w-100" alt="Promoción 3" style="max-height: 480px; object-fit: cover;; background-color: #00aff0;">
                    <img src="/img/Carrucel3M.png" class="d-block d-md-none w-100" style="height: 600px; object-fit: cover;" alt="Banner">
                </div>
            </div>

            <!-- Controles (flechas) -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="container d-flex align-items-center justify-content-between pt-5 pb-5">

            <div class="card" style="width: 18rem; height: 18rem;">
                <img src="/img/phoneC.svg" alt="telefono" width="90px" height="60px">
                <div class="card-body">
                    <h5 class="card-title">Telefono</h5>
                    <p class="card-text pt-5">+54 3794 667788</p>
                </div>
            </div>

            <div class="card" style="width: 18rem; height: 18rem;">
                <img src="/img/correoC.svg" alt="correo" width="90px" height="60px">
                <div class="card-body">
                    <h5 class="card-title">Email</h5>
                    <p class="card-text pt-5">correoInventado@gmail.com</p>
                </div>
            </div>

            <div class="card" style="width: 18rem; height: 18rem;">
                <img src="/img/relojC.svg" alt="horario" width="90px" height="60px">
                <div class="card-body">
                    <h5 class="card-title">Horario</h5>
                    <p class="card-text pt-5">Lunes-Sabado: 15:20h - 23:30h</p>
                </div>
            </div>

        </div>

    </main>
    @endsection
    
    
</html>
