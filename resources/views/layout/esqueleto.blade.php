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

        @include('partials.footer')<!-- esto incluye el footer en todas las paginas que usen este esqueleto -->

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>