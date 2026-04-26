<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro OnlyMotos.com</title>
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    </head>

    <body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #131212">

        <main class="container px-4">
            <div class="card mx-auto w-100" style="max-width: 420px;">
                <div class="card-body">
                    <h1 class="card-title text-center">Resgistrarse</h1>

                    <form action="{{ url('/registro') }}" method="POST">
                        @csrf <!-- Token de seguridad para evitar ataques CSRF -->

                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Ingrese su Nombre Completo" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">DNI</label>
                            <input name="dni" type="text" class="form-control" placeholder="Ingrese su DNI (sin puntos ni guiones)" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input name="fecha_nacimiento" type="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gmail</label>
                            <input name="usuario" type="email" class="form-control" placeholder="micorreo@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input name="contrasena" type="password" class="form-control" placeholder="Ingrese su contraseña" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>

                    </form>
                    
                    <div class="mt-3 text-center">
                        <p>¿ya tienes una cuenta? <a href="/IniciarSesion">Inicia Sesion</a></p>
                    </div>

                </div>
            </div>
        </main>

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>
</html>