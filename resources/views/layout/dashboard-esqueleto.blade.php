<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin | @yield('title', 'Only Motos')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <style>
        :root {
            --admin-gradient: radial-gradient(circle at center, #740df2 0%, #0c0517 70%, #630eed 100%);
            --admin-accent: #9101ff; 
        }

        body {
            background: #f8f9fa;
        }

        .dashboard-header, .dashboard-footer {
            background: var(--admin-gradient);
            border-bottom: 2px solid rgba(145, 1, 255, 0.2);
            color: #ffffff;
        }

        .dashboard-footer {
            border-top: 2px solid rgba(145, 1, 255, 0.2);
            border-bottom: none;
        }

        .nav-admin-link {
            color: rgb(0, 0, 0);
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            border-radius: 4px;
        }
        .nav-admin-link:hover, .nav-admin-link.active {
            color: #ffffff !important;
            background: rgba(145, 1, 255, 0.3);
            text-shadow: 0 0 8px rgba(145, 1, 255, 0.6);
        }

        @media (min-width: 768px) {
            .dashboard-sidebar-nav {
                min-height: calc(100vh - 130px);
                border-right: 1px solid #dee2e6;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="dashboard-header py-3 px-3 px-md-4 shadow-sm">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            
            <div class="d-flex align-items-center gap-2 gap-md-3">
                <button class="btn btn-outline-light d-md-none border-0 px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fs-3">☰</span>
                </button>

                <a href="{{ route('dashboard.index') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <img src="/img/adminW.svg" width="30" height="30" alt="">
                    <span class="fs-4 fw-bold font-monospace tracking-tight">ONLYMOTOS <span style="color: var(--admin-accent)">PRO</span></span>
                </a>
                <span class="badge text-uppercase shadow px-2 py-1 d-none d-sm-inline-block" style="background-color: var(--admin-accent); font-size: 0.75rem;">
                    PANEL DE CONTROL
                </span>
            </div>

            <div class="d-flex align-items-center gap-3 gap-md-4 ms-auto ms-md-0">
                <span class="text-white-50 small d-none d-md-inline">Sesión activa: <strong class="text-white">{{ auth()->user()->name }}</strong></span>
                
                <a href="/" class="btn btn-sm btn-danger d-flex align-items-center gap-2 px-3 shadow-sm border-0" style="background-color: #dc3545; transition: 0.2s;">
                    <span class="d-none d-sm-inline">Volver al Inicio</span> 
                    <strong style="font-size: 1.1rem; line-height: 1;">➔</strong>
                </a>
            </div>
        </div>
    </header>


    <div class="container-fluid flex-grow-1">
        <div class="row">
            
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block dashboard-sidebar-nav p-3 collapse bg-white border-bottom border-md-bottom-0">
                <div class="d-flex flex-column gap-1">
                    <div class="text-muted small fw-bold text-uppercase px-2 mb-2 tracking-wider">Módulos de Gestión</div>
                    
                    <a href="{{ route('dashboard.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('dashboard.index') ? 'active' : '' }} mb-1">
                        📊 Vista General
                    </a>
                    <a href="{{ route('admin.motos.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.motos.*') ? 'active' : '' }} mb-1">
                        🏍️ Inventario Motos
                    </a>
                    <a href="{{ route('admin.ventas.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.ventas.*') ? 'active' : '' }} mb-1">
                        💰 Facturación y Ventas
                    </a>
                    <a href="{{ route('admin.usuarios.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }} mb-1">
                        👤 Control Usuarios
                    </a>
                    
                    <div class="text-muted small fw-bold text-uppercase px-2 mt-3 mb-2 tracking-wider">Seguridad y Soporte</div>
                    
                    <a href="{{ route('notificaciones.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('notificaciones.*') ? 'active' : '' }} mb-1">
                        🔔 Alertas y Consultas
                    </a>
                    <a href="{{ route('auditoria.index') }}" class="nav-link nav-admin-link px-3 py-2 {{ request()->routeIs('auditoria.*') ? 'active' : '' }} mb-1">
                        🔒 Libro de Auditoría
                    </a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-3 px-md-4 py-4 bg-light">
                @yield('contenido')
            </main>
        </div>
    </div>

    <footer class="dashboard-footer py-3 text-center text-white-50 mt-auto small px-3">
        <p class="mb-0">&copy; {{ date('Y') }} - Only Motos S.A. | Entorno Seguro de Administración Restringida.</p>
    </footer>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

