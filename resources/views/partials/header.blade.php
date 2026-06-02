<header class="navbar navbar-expand-lg bgCandy sticky-top d-block p-0">
     <div class="container-fluid d-flex align-items-center py-2">
        <a href="/" class="btn btn-outline-light border-0 image-toggle-container">
            <!-- Imagen que se ve al inicio -->
            <img src="/img/logosinA.png" class="img-front" width="115px" height="auto">
                        
            <!-- Imagen que se ve al tocar/hover -->
            <img src="/img/logosinB.png" class="img-back" width="115px" height="auto">
        </a>
                
        <div class="ms-auto d-flex align-items-center">
            <a href="#" class="btn btn-outline-light border-0 image-toggle-container" id="carritoBtn">
                <!-- Imagen que se ve al inicio -->
                <img src="/img/shopW.svg" class="img-front">
                        
                <!-- Imagen que se ve al tocar/hover -->
                <img src="/img/shopB.svg" class="img-back">
            </a>

            {{-- <a href="/" class="btn btn-outline-light border-0 image-toggle-container">
                <!-- Imagen que se ve al inicio -->
                <img src="/img/starW.svg" class="img-front">
                        
                <!-- Imagen que se ve al tocar/hover -->
                <img src="/img/starB.svg" class="img-back">
            </a> favoritos boton no se si es necesario y  vemos si lo hacemos--}}

            {{-- <p class="mb-0 text-dark img-front">variable nombre de usuario</p>  --}}

            @auth

                <a href="/IniciarSesion" class="btn btn-outline-light border-0 image-toggle-container d-flex align-items-center gap-2 text-decoration-none">
                    <span class="nombre-usuario text-black mb-0">{{ auth()->user()->name }}</span>
                    <div class="position-relative" style="width: 24px; height: 24px;">
                        <!-- Imagen que se ve al inicio -->
                        <img src="/img/userW.svg" class="img-front">   
                        <!-- Imagen que se ve al tocar/hover -->
                        <img src="/img/userB.svg" class="img-back">
                    </div>
                </a>

            @else

                <a href="/IniciarSesion" class="btn btn-outline-light border-0 image-toggle-container d-flex align-items-center gap-2 text-decoration-none">
                    <span class="nombre-usuario text-black mb-0">Ingresar</span>
                    <div class="position-relative" style="width: 24px; height: 24px;">
                        <!-- Imagen que se ve al inicio -->
                        <img src="/img/userW.svg" class="img-front">   
                        <!-- Imagen que se ve al tocar/hover -->
                        <img src="/img/userB.svg" class="img-back">
                    </div>
                </a>


            @endauth

        </div>
    </div>

    <div class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <!-- Botón Hamburguesa (solo se ve en celulares) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor de los links -->
        <div class="collapse navbar-collapse" id="menuNavegacion">
            <div class="navbar-nav w-100 d-flex justify-content-between align-items-center text-center">
                <a href="/Quienes-Somos" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Quiénes Somos</a>
                <a href="/Catalogo" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Catálogo</a>
                <a href="/Comercializacion" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Comercialización</a>
                <a href="/Terminos-y-Condiciones" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Términos y Condiciones</a>
                <a href="/Contactos" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Contactos</a>
            </div>
        </div>
    </div>
</div>
</header>