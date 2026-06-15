<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | OnlyMotos.com</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #131212">

    <main class="container px-4">
        <div class="card mx-auto w-100" style="max-width: 420px; border-radius: 10px; border: none; shadow-sm">
            <div class="card-body p-4">
                <h1 class="card-title text-center mb-4 fw-bold">Inicio de Sesión</h1>

                @if(session('error'))
                    <div class="alert alert-danger py-2 px-3 small border-0 mb-3" style="border-radius: 6px;">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 small border-0 mb-3" style="border-radius: 6px;">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('login.conectar') }}" method="POST">
                    @csrf 
                    
                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold">Email</label>
                        <!-- 'old' mantiene el texto escrito para que el usuario no tenga que reescribirlo si falla -->
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="nombre@ejemplo.com" required>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-bold">Contraseña</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Ingrese su contraseña" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Ingresar</button>
                </form>

                <div class="mt-4 text-center small text-muted">
                    <p class="mb-0">¿No tienes una cuenta? <a href="{{ route('register.mostrar') }}" class="text-decoration-none fw-semibold">Regístrate aquí</a></p>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
