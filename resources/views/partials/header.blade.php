<header class="navbar navbar-expand-lg bgCandy sticky-top d-block p-0">
    <div class="container-fluid d-flex align-items-center py-2">
        <a href="{{ route('welcome') }}" class="btn btn-outline-light border-0 shadow-sm image-toggle-container">
            <img src="/img/logosinA.png" class="img-front" width="115px" height="auto">
            <img src="/img/logosinB.png" class="img-back" width="115px" height="auto">
        </a>
                
        <div class="ms-auto d-flex align-items-center gap-3">
            
            @auth
                <a href="#" class="btn btn-outline-light border-0 shadow-sm image-toggle-container position-relative" id="carritoBtn">
                    <img src="/img/shopW.svg" class="img-front" alt="Carrito">
                    <img src="/img/shopB.svg" class="img-back" alt="Carrito">
                    
                    @if(isset($conteoCarrito) && $conteoCarrito > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.75rem;">
                            {{ $conteoCarrito }}
                        </span>
                    @endif
                </a>

                <div class="d-flex align-items-center h-100">
                    <span class="badge text-uppercase shadow px-3 py-2" 
                        style="background-color: {{ auth()->user()->role === 'admin' ? '#9101ff' : '#6c757d' }}; color: white; font-size: 0.85rem; border-radius: 6px;">
                        {{ auth()->user()->role }}
                    </span>
                </div>

                <a href="{{ route('verPerfil') }}" class="btn btn-outline-light border-0 shadow-sm image-toggle-container d-flex align-items-center gap-2 text-decoration-none">
                    <span class="nombre-usuario text-black mb-0">{{ auth()->user()->name }}</span>
                    <div class="position-relative" style="width: 24px; height: 24px;">
                        <img src="/img/userW.svg" class="img-front">   
                        <img src="/img/userB.svg" class="img-back">
                    </div>
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard.index') }}" class="btn btn-outline-light border-0 shadow-sm image-toggle-container d-flex align-items-center gap-2 text-decoration-none">
                        <div class="position-relative" style="width: 24px; height: 24px;">
                            <img src="/img/adminW.svg" class="img-front">   
                            <img src="/img/adminB.svg" class="img-back">
                        </div>
                    </a>
                @endif

            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light border-0 shadow-sm image-toggle-container d-flex align-items-center gap-2 text-decoration-none">
                    <span class="nombre-usuario text-black mb-0">Ingresar</span>
                    <div class="position-relative" style="width: 24px; height: 24px;">
                        <img src="/img/userW.svg" class="img-front">   
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
                <a href="{{ route('quienes.somos') }}" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Quiénes Somos</a>
                <a href="{{ route('catalogo.index') }}" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Catálogo</a>
                <a href="{{ route('comercializacion') }}" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Comercialización</a>
                <a href="{{ route('terminos.condiciones') }}" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Términos y Condiciones</a>
                <a href="{{ route('contactos') }}" class="nav-link btn btn-outline-danger border-0 px-3 text-white">Contactos</a>
            </div>
        </div>
    </div>
</div>
</header>