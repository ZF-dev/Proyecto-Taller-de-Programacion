<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Motochorros" (motos robadas)') </title><!-- esto hace que cada pagina que use este esqueleto pueda poner su propio titulo, y si no lo pone se pone el que esta entre comillas -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="/css/styles.css">
        <link href="https://googleapis.com" rel="stylesheet">
    </head>

     <!-- esto hace que el body trate de ocupar el 100% de la pantalla -->
    <body class="d-flex flex-column min-vh-100">
        @include('partials.header') <!-- esto incluye el header en todas las paginas que usen este esqueleto -->

            <!-- esto hace que el main trate de estirarse hasta el fin de pagina osea el footer -->
        <main class="flex-grow-1 white"> 
            @yield('contenido')<!-- esto hace que cada pagina que use este esqueleto pueda poner su contenido en esta seccion -->
        </main>

        <!-- Sidebar global, fuera del header -->
        <div id="sidebarCarrito" class="sidebar">
            <h2><img src="/img/carritoIcono.png" alt="Carrito" width="24" height="24" style="vertical-align: middle;"> <b>Carrito</b></h2>
            @if(session('carrito') && count(session('carrito')) > 0)
                @foreach(session('carrito') as $item)
                    <div class="carrito-item">
                        <img src="{{ asset($item['imagen']) }}" width="50" height="50" alt="{{ $item['nombre'] }}">
                        <p>{{ $item['nombre'] }} - ${{ number_format($item['precio'], 2) }} x {{ $item['cantidad'] }}</p>
                        <form method="POST" action="/carrito/eliminar" style="display: inline;">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item['id'] }}">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                @endforeach
                <hr>
                <p><strong>Total: ${{ number_format(collect(session('carrito'))->sum(function($item) { return $item['precio'] * $item['cantidad']; }), 2) }}</strong></p>
                <a href="/carrito" class="btn btn-primary">Ver carrito completo</a>
            @else
                <p>El carrito está vacío.</p>
            @endif
        </div>

        @include('partials.footer')<!-- esto incluye el footer en todas las paginas que usen este esqueleto -->

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => { // Asegura que el DOM esté cargado antes de ejecutar el script
                const cartBtn = document.getElementById("carritoBtn");// Botón del carrito en el header
                const sidebar = document.getElementById("sidebarCarrito");// Sidebar del carrito

                cartBtn.addEventListener("click", () => { // Agrega un evento de clic al botón del carrito
                    sidebar.classList.toggle("show"); // Alterna la clase "show" para mostrar u ocultar el sidebar
                });
            });
        </script>

    </body>
</html>