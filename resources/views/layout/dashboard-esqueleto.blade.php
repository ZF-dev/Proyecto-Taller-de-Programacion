<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin | @yield('title', 'Only Motos')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <style>
        /* 🎨 DEFINICIÓN DEL ESTILO RADIAL EXCLUSIVO PARA ADMIN */
        :root {
            /* Degradado premium y tecnológico (Negro profundo hacia violeta/azul oscuro de fondo) */
            --admin-gradient: radial-gradient(circle at center, #1e0b36 0%, #0c0517 70%, #05020a 100%);
            --admin-accent: #9101ff; /* El violeta de tu rol admin */
        }

        body {
            background: #f8f9fa; /* Fondo gris claro limpio para las tablas/contenido del medio */
        }

        /* Forzamos el degradado radial en Header y Footer anulando interferencias */
        .dashboard-header, .dashboard-footer {
            background: var(--admin-gradient) ;
            border-bottom: 2px solid rgba(145, 1, 255, 0.2);
            color: #ffffff ;
        }

        .dashboard-footer {
            border-top: 2px solid rgba(145, 1, 255, 0.2);
            border-bottom: none;
        }

        /* Estilo para los links del menú administrativo */
        .nav-admin-link {
            color: rgb(0, 0, 0);
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            border-radius: 4px;
        }
        .nav-admin-link:hover, .nav-admin-link.active {
            color: #ffffff ;
            background: rgba(145, 1, 255, 0.3);
            text-shadow: 0 0 8px rgba(145, 1, 255, 0.6);
        }

        /* Sidebar flotante adaptado al estilo oscuro del dashboard */
        .dashboard-sidebar-nav {
            background: #ffffff;
            border-right: 1px solid #dee2e6;
            min-height: calc(100vh - 130px);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="dashboard-header py-3 px-4 shadow-sm">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('dashboard.index') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <img src="/img/adminW.svg" width="30" height="30" alt="">
                    <span class="fs-4 fw-bold font-monospace tracking-tight">ONLYMOTOS <span style="color: var(--admin-accent)">PRO</span></span>
                </a>
                <span class="badge text-uppercase shadow px-2 py-1" style="background-color: var(--admin-accent); font-size: 0.75rem;">
                    PANEL DE CONTROL
                </span>
            </div>

            <!-- Información del Admin logueado y Botón de Salida -->
            <div class="d-flex align-items-center gap-4">
                <span class="text-white-50 small">Sesión activa: <strong class="text-white">{{ auth()->user()->name }}</strong></span>
                
                <!-- 🚪 BOTÓN DE SALIDA DEL DASHBOARD AL INICIO -->
                <a href="/" class="btn btn-sm btn-danger d-flex align-items-center gap-2 px-3 shadow-sm border-0" style="background-color: #dc3545; transition: 0.2s;">
                    <!-- Usamos un ícono básico de flecha o texto si no tenés Bootstrap Icons -->
                    <span>Volver al Inicio</span> 
                    <strong style="font-size: 1.1rem; line-height: 1;">➔</strong>
                </a>
            </div>
        </div>
    </header>


    <!-- 2. CUERPO ESTRUCTURAL (Menú Lateral + Contenido Variable) -->
    <div class="container-fluid flex-grow-1">
        <div class="row">
            <!-- Menú Navegación del Dashboard -->
            <nav class="col-md-3 col-lg-2 d-md-block dashboard-sidebar-nav p-3 collapse d-md-flex flex-column gap-1">
                <div class="text-muted small fw-bold text-uppercase px-2 mb-2 tracking-wider">Módulos de Gestión</div>
                
                <a href="{{ route('dashboard.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('dashboard.index') ? 'active' : '' }} text-dark mb-1">
                    📊 Vista General
                </a>
                <a href="{{ route('admin.motos.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.motos.*') ? 'active' : '' }} text-dark mb-1">
                    🏍️ Inventario Motos
                </a>
                <a href="{{ route('admin.ventas.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.ventas.*') ? 'active' : '' }} text-dark mb-1">
                    💰 Facturación y Ventas
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }} text-dark mb-1">
                    👤 Control Usuarios
                </a>
                
                <div class="text-muted small fw-bold text-uppercase px-2 mt-3 mb-2 tracking-wider">Seguridad y Soporte</div>
                
                <a href="{{ route('notificaciones.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('notificaciones.*') ? 'active' : '' }} text-dark mb-1">
                    🔔 Alertas y Consultas
                </a>
                <a href="{{ route('auditoria.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('auditoria.*') ? 'active' : '' }} text-dark mb-1">
                    🔒 Libro de Auditoría
                </a>
            </nav>

            <!-- Contenido Principal Dinámico -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
                @yield('contenido')
            </main>
        </div>
    </div>

    <!-- 3. FOOTER EXCLUSIVO DASHBOARD -->
    <footer class="dashboard-footer py-3 text-center text-white-50 mt-auto small">
        <p class="mb-0">&copy; {{ date('Y') }} - Only Motos S.A. | Entorno Seguro de Administración Restringida.</p>
    </footer>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
