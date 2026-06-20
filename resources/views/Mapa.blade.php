@extends('layout.esqueleto')

@section('title', 'Mapa')

@section('contenido')
<main class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1 class="display-5 fw-bold text-primary">Nuestra Ubicación</h1>
            <p class="lead text-muted">Te esperamos en las instalaciones de Only Motos S.R.L.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Card contenedora con las sombras predeterminadas de Bootstrap -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Utilidad 'ratio' de Bootstrap para hacer el iframe responsivo (Proporción 21x9 ideal para mapas anchos) -->
                <div class="ratio ratio-21x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510.7337206640916!2d-58.61703769284763!3d-34.76990260707544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcc4f155c4851f%3A0x137728091fc91553!2sAtalco%205848%2C%20B1758ETD%20Gonz%C3%A1lez%20Cat%C3%A1n%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1781018299763!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <!-- Opcional: Una barra de pie de tarjeta con un botón de acción rápida -->
                <div class="card-footer bg-light text-center py-3">
                    <a href="https://maps.app.goo.gl/sc89UGKNvnvsAjALA" target="_blank" class="btn btn-outline-primary fw-bold">
                        Abrir directamente en Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
