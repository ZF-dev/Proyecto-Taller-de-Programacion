<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Only Motos')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('partials.header')

    <main class="flex-grow-1 bg-white"> 
        @yield('contenido')
    </main>

    <!-- Sidebar global del Carrito (Usa tu modelo VentaItem unificado) -->
    <div id="sidebarCarrito" class="sidebar bg-white shadow-lg border-start p-3" style="position: fixed; right: -350px; top: 0; width: 350px; height: 100vh; transition: 0.3s; z-index: 1050; overflow-y: auto;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                <img src="{{ asset('img/carritoIcono.png') }}" alt="" width="24" height="24" class="me-2">
                <b>Mi Carrito</b>
            </h4>
            <button type="button" class="btn-close" id="cerrarSidebarBtn"></button>
        </div>
        
        <hr>

        @if(auth()->check() && $carritoSidebar->isNotEmpty())
            <div class="carrito-items-lista mb-4">
                @foreach($carritoSidebar as $item)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <img src="{{ asset($item->moto->imagen ?? 'img/default-moto.jpg') }}" width="50" height="50" alt="" class="rounded me-2" style="object-fit: cover;">
                        <div class="flex-grow-1 small">
                            <p class="mb-0 fw-bold text-truncate" style="max-width: 180px;">
                                {{ $item->moto->nombre ?? $item->moto_modelo_historico }}
                            </p>
                            <p class="mb-0 text-muted">
                                ${{ number_format($item->precio_unitario, 2, ',', '.') }} x {{ $item->cantidad }}
                            </p>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <!-- Botón Menos (-) -->
                                <form method="POST" action="{{ route('carrito.modificar') }}" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="producto_id" value="{{ $item->moto_id }}">
                                    <input type="hidden" name="accion" value="restar">
                                    <button type="submit" class="btn btn-xs btn-outline-secondary py-0 px-2 fw-bold" style="font-size: 0.75rem;">-</button>
                                </form>

                                <span class="fw-bold px-1 text-dark" style="font-size: 0.85rem;">{{ $item->cantidad }}</span>

                                <!-- Botón Más (+) -->
                                <form method="POST" action="{{ route('carrito.modificar') }}" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="producto_id" value="{{ $item->moto_id }}">
                                    <input type="hidden" name="accion" value="sumar">
                                    <button type="submit" class="btn btn-xs btn-outline-dark py-0 px-2 fw-bold" style="font-size: 0.75rem;">+</button>
                                </form>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('carrito.eliminar') }}" class="ms-2">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item->moto_id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">✕</button>
                        </form>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-auto">
                <h5 class="d-flex justify-content-between mb-3">
                    <span>Total:</span>
                    <span class="text-success">${{ number_format($totalCarrito, 2, ',', '.') }}</span>
                </h5>
                <a href="{{ route('carrito.mostrar') }}" class="btn btn-primary w-100 mb-2">Ver carrito completo</a>
                <a href="{{ route('finalizarCompra.vista') }}" class="btn btn-success w-100">Proceder al pago</a>
            </div>
        @else
            <p class="text-muted text-center py-4">El carrito está vacío.</p>
        @endif
    </div>

    @include('partials.footer')

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cartBtn = document.getElementById("carritoBtn");
            const cerrarBtn = document.getElementById("cerrarSidebarBtn");
            const sidebar = document.getElementById("sidebarCarrito");

            if (sidebar) {
                sidebar.style.right = "-350px";
            }

            if (cartBtn && sidebar) {
                cartBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    e.stopPropagation(); 
                    
                    if (sidebar.style.right === "0px") {
                        sidebar.style.right = "-350px";
                    } else {
                        sidebar.style.right = "0px";
                    }
                });
            }

            if (cerrarBtn && sidebar) {
                cerrarBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    sidebar.style.right = "-350px";
                });
            }

            document.addEventListener("click", (e) => {
                if (sidebar && sidebar.style.right === "0px") {
                    if (!sidebar.contains(e.target) && e.target !== cartBtn && !cartBtn.contains(e.target)) {
                        sidebar.style.right = "-350px";
                    }
                }
            });
        });
    </script>

</body>
</html>
