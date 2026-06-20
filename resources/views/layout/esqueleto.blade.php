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
                    <!-- Identificamos el contenedor de la fila con el ID de la moto -->
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom fila-carrito" data-moto-id="{{ $item->moto_id }}">
                        <img src="{{ $item->moto->imagen ?? 'img/default-moto.jpg' }}" width="50" height="50" alt="" class="rounded me-2" style="object-fit: cover;">
                        
                        <div class="flex-grow-1 small">
                            <p class="mb-0 fw-bold text-truncate" style="max-width: 180px;">
                                {{ $item->moto->nombre ?? $item->moto_modelo_historico }}
                            </p>
                            <p class="mb-1 text-muted">
                                ${{ number_format($item->precio_unitario, 2, ',', '.') }} c/u
                            </p>
                            
                            <!-- 🎛️ BOTONERA ASINCRÓNICA CON CAPTURA JS -->
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2 fw-bold btn-ajax-modificar" data-accion="restar" data-id="{{ $item->moto_id }}" style="font-size: 0.75rem;">-</button>
                                
                                <!-- ID de clase para modificar el número en vivo -->
                                <span class="fw-bold px-1 text-dark visor-cantidad" style="font-size: 0.85rem;">{{ $item->cantidad }}</span>
                                
                                <button type="button" class="btn btn-xs btn-outline-dark py-0 px-2 fw-bold btn-ajax-modificar" data-accion="sumar" data-id="{{ $item->moto_id }}" style="font-size: 0.75rem;">+</button>
                            </div>
                        </div>
                        
                        <form method="POST" action="/carrito/eliminar" class="ms-2">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item->moto_id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">✕</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-auto block-totales">
                <h5 class="d-flex justify-content-between mb-3">
                    <span>Total:</span>
                    <span class="text-success fw-bold text-total-global">${{ number_format($totalCarrito, 2, ',', '.') }}</span>
                </h5>
                <a href="{{ route('carrito.mostrar') }}" class="btn btn-primary w-100 mb-2">Ver carrito completo</a>
                <a href="{{ route('finalizar.compra') }}" class="btn btn-success w-100">Proceder al pago</a>
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

    if (sidebar) { sidebar.style.right = "-350px"; }

    // Control de apertura del sidebar tradicional (Se mantiene tu lógica que ya anda de diez)
    if (cartBtn && sidebar) {
        cartBtn.addEventListener("click", (e) => {
            e.preventDefault(); e.stopPropagation();
            sidebar.style.right = sidebar.style.right === "0px" ? "-350px" : "0px";
        });
    }
    if (cerrarBtn && sidebar) {
        cerrarBtn.addEventListener("click", () => { sidebar.style.right = "-350px"; });
    }

    document.querySelectorAll('.btn-ajax-modificar').forEach(boton => {
        boton.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const productoId = boton.getAttribute('data-id');
            const accion = boton.getAttribute('data-accion');
            const filaContenedora = boton.closest('.fila-carrito');
            const visorCantidad = filaContenedora.querySelector('.visor-cantidad');

            try {
                const respuesta = await fetch("{{ route('carrito.modificar') }}", {
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        producto_id: productoId,
                        accion: accion
                    })
                });

                const datos = await respuesta.json();

                if (!respuesta.ok) {
                    alert(datos.error ?? 'Ocurrió un inconveniente.');
                    return;
                }

                if (datos.success) {
                    if (datos.removido) {
                        filaContenedora.remove();
                        
                        const lista = document.querySelector('.carrito-items-lista');
                        if (lista && lista.children.length === 0) {
                            lista.innerHTML = '<p class="text-muted text-center py-4">El carrito está vacío.</p>';
                            const blockTotales = document.querySelector('.block-totales');
                            if (blockTotales) blockTotales.remove();
                        }
                    } else {
                        visorCantidad.textContent = datos.cantidad;
                    }

                    const totalGlobal = document.querySelector('.text-total-global');
                    if (totalGlobal) {
                        totalGlobal.textContent = '$' + datos.totalCarrito.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    }

                    const badgeHeader = document.querySelector('#carritoBtn .badge');
                    if (badgeHeader) {
                        if (datos.conteoCarrito > 0) {
                            badgeHeader.textContent = datos.conteoCarrito;
                        } else {
                            badgeHeader.remove();
                        }
                    }
                }

            } catch (error) {
                console.error("Falla en comunicación asincrónica:", error);
                alert('No se pudo actualizar la cantidad en este momento.');
            }
        });
    });
});
</script>


</body>
</html>
