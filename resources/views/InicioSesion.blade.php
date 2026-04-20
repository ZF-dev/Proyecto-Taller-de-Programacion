<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio de Sesion OnlyMotos.com</title>
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    </head>

    <body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #131212">

        <main class="container px-4">
            <div class="card mx-auto w-100" style="max-width: 420px;">
                <div class="card-body">
                    <h1 class="card-title text-center">Inicio de Sesion</h1>

                    
                    <form method="POST" action="/">
                        @csrf <!-- Token de seguridad para evitar ataques CSRF -->
                        <div class="mb-3">
                            <label class="form-label">Usuario/Gmail</label>
                            <input name="usuario" type="text" class="form-control" placeholder="Ingrese su Usuario">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input name="contrasena" type="password" class="form-control" placeholder="Ingrese su contraseña">
                        </div>

                        <button type="button" class="btn btn-primary w-100"  onclick="window.location.href='/'">Ingresar</button>
                        <!--button type="submit" class="btn btn-primary w-100">Ingresar</button  para cuando mande los datos para procesar-->
                    </form>

                    <div class="mt-3 text-center">
                        <p>¿No tienes una cuenta? <a href="/registro">Regístrate aquí</a></p>
                    </div>

                </div>
            </div>
        </main>

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>
</html>