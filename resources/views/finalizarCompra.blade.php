@extends('layout.esqueleto')

@section('title', 'Finalizar Compra')

@section('contenido')
<div class="container mt-5 mb-5">
    <h1 class="mb-4">Finalizar Compra</h1>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm px-4 py-3 mb-4" style="border-radius: 8px;">
            🎉 <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm px-4 py-3 mb-4" style="border-radius: 8px;">
            ⚠️ <strong>Error en Operación:</strong> {{ session('error') }}
        </div>
    @endif

    <!-- Lista de fallas de validación de inputs de Laravel -->
    @if($errors->any())
        <div class="alert alert-danger py-2 px-3 small border-0 mb-4" style="border-radius: 6px;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('finalizarCompra.procesar') }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Sección 1: Selección de Envío -->
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white shadow-sm rounded border">
                    <h3 class="mb-3">Método de Envío</h3>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodo_envio" id="retirarLocal" value="retirar" checked>
                        <label class="form-check-label fw-bold" for="retirarLocal">Retirar en Local</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodo_envio" id="envioNormal" value="normal">
                        <label class="form-check-label fw-bold" for="envioNormal">Envío Normal</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodo_envio" id="envioExpress" value="express">
                        <label class="form-check-label fw-bold" for="envioExpress">Envío Express</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodo_envio" id="proBox" value="probox">
                        <label class="form-check-label fw-bold" for="proBox">Pro-Box</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white shadow-sm rounded border">
                    <h3 class="mb-3">Datos de Pago</h3>

                    <div class="mb-3">
                        <label for="titular_pago" class="form-label">Nombre del Titular / Pagador</label>
                        <input type="text" class="form-control" id="titular_pago" name="titular_pago" placeholder="Nombre completo de quien paga" required>
                    </div>

                    <div class="mb-3">
                        <label for="dni_pagador" class="form-label">DNI del Pagador</label>
                        <input type="number" class="form-control" id="dni_pagador" name="dni_pagador" placeholder="Número de documento sin puntos" required>
                    </div>

                    <label class="form-label d-block fw-bold mt-4">Seleccioná cómo querés pagar:</label>
                    <div class="mb-4 p-2 bg-light rounded d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="pagoTarjeta" value="tarjeta" checked onclick="alternarFormularioPago('tarjeta')">
                            <label class="form-check-label" for="pagoTarjeta">Tarjeta de Débito / Crédito</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="pagoTransferencia" value="transferencia" onclick="alternarFormularioPago('transferencia')">
                            <label class="form-check-label" for="pagoTransferencia">Transferencia Bancaria</label>
                        </div>
                    </div>

                    <div id="bloqueTarjeta" class="p-3 bg-light rounded mb-4">
                        <div class="mb-3">
                            <label for="numeroTarjeta" class="form-label">Número de Tarjeta</label>
                            <input type="text" class="form-control campos-tarjeta" id="numeroTarjeta" name="numeroTarjeta" placeholder="1234567890123456" maxlength="16" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fechaExpiracion" class="form-label">Fecha de Expiración</label>
                                <input type="text" class="form-control campos-tarjeta" id="fechaExpiracion" name="fechaExpiracion" placeholder="MM/AA" maxlength="5" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="password" class="form-control campos-tarjeta" id="cvv" name="cvv" placeholder="123" maxlength="4" required>
                            </div>
                        </div>
                    </div>

                    <!-- 🏦 BLOQUE TRANSFERENCIA (Oculto por defecto con d-none) -->
                    <div id="bloqueTransferencia" class="p-3 bg-light rounded mb-4 d-none">
                        <div class="alert alert-info py-2 small mb-3">
                            <p class="mb-1"><strong>CBU:</strong> 0000003100012345678901</p>
                            <p class="mb-1"><strong>Alias:</strong> onlymotos.concesionaria.mp</p>
                            <p class="mb-0"><strong>Banco:</strong> Mercado Pago</p>
                        </div>
                        <div class="mb-3">
                            <label for="comprobante" class="form-label">Número de Comprobante / Operación</label>
                            <input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Ej: 984512345">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fs-5">Confirmar y Procesar Venta</button>
                </div>
            </div>
        </div>
        
    </form>
</div>

<script>
function alternarFormularioPago(metodo) {
    const bloqueTarjeta = document.getElementById('bloqueTarjeta');
    const bloqueTransferencia = document.getElementById('bloqueTransferencia');
    const camposTarjeta = document.querySelectorAll('.campos-tarjeta');
    const campoComprobante = document.getElementById('comprobante');

    if (metodo === 'tarjeta') {
        // Mostrar tarjeta, ocultar transferencia
        bloqueTarjeta.classList.remove('d-none');
        bloqueTransferencia.classList.add('d-none');
        
        // Hacer requeridos los inputs de tarjeta y quitar transferencia
        camposTarjeta.forEach(input => input.setAttribute('required', 'true'));
        campoComprobante.removeAttribute('required');
    } else {
        // Ocultar tarjeta, mostrar transferencia
        bloqueTarjeta.classList.add('d-none');
        bloqueTransferencia.classList.remove('d-none');
        
        // Quitar requeridos de tarjeta y exigir el comprobante
        camposTarjeta.forEach(input => input.removeAttribute('required'));
        campoComprobante.setAttribute('required', 'true');
    }
}
</script>
@endsection
