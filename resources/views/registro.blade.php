<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | OnlyMotos.com</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #131212">

    <main class="container px-4">
        <div class="card mx-auto w-100" style="max-width: 420px; border-radius: 10px; border: none; shadow-sm">
            <div class="card-body p-4">
                <h1 class="card-title text-center mb-4 fw-bold">Registrarse</h1>

                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 small border-0 mb-3" style="border-radius: 6px;">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.crear') }}" method="POST">
                    @csrf 

                    <div class="mb-3">
                        <label for="name" class="form-label small fw-bold">Nombre Completo</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" placeholder="Ingrese su Nombre Completo" required>
                    </div>

                    <div class="mb-3">
                        <label for="dni" class="form-label small fw-bold">DNI</label>
                        <input id="dni" name="dni" type="text" class="form-control @error('dni') is-invalid @enderror" 
                               value="{{ old('dni') }}" placeholder="Ingrese su DNI (sin puntos ni guiones)" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label small fw-bold">Fecha de Nacimiento</label>
                        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" 
                               class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                               value="{{ old('fecha_nacimiento') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="micorreo@email.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-bold">Contraseña (6 o más dígitos)</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Ingrese su contraseña" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Registrarse</button>

                </form>
                
                <div class="mt-4 text-center small text-muted">
                    <p class="mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Inicia Sesión</a></p>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
