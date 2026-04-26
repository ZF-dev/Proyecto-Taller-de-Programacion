<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('title', 'Finalizar Compra')

    @section('contenido')
    <div class="container mt-5 mb-5">
        <h1 class="mb-4">Finalizar Compra</h1>

        <div class="row">
            <!-- Sección 1: Selección de Envío -->
            <div class="col-md-6">
                <h3>Selecciona el Método de Envío</h3>
                <form>
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="retirarLocal" value="retirar" checked>
                        <label class="form-check-label" for="retirarLocal">
                            Retirar en Local
                        </label>
                    </div>
                    <p class="text-muted">No rellene nada y se presente, yo me encargo del resto.</p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="envioNormal" value="normal">
                        <label class="form-check-label" for="envioNormal">
                            Envío Normal
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="envioExpress" value="express">
                        <label class="form-check-label" for="envioExpress">
                            Envío Express
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="proBox" value="probox">
                        <label class="form-check-label" for="proBox">
                            Pro-Box
                        </label>
                    </div>
                </form>
            </div>

            <!-- Sección 2: Datos de Pago -->
            <div class="col-md-6">
                <h3>Datos de Pago</h3>
                <form action="{{ url('/finalizarCompra') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="numeroTarjeta" class="form-label">Número de Tarjeta</label>
                        <input type="text" class="form-control" id="numeroTarjeta" placeholder="1234 5678 9012 3456" maxlength="19" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fechaExpiracion" class="form-label">Fecha de Expiración</label>
                            <input type="text" class="form-control" id="fechaExpiracion" placeholder="MM/AA" maxlength="5" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="4" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nombreTitular" class="form-label">Nombre del Titular</label>
                        <input type="text" class="form-control" id="nombreTitular" placeholder="Como aparece en la tarjeta" required>
                    </div>

                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI del Titular</label>
                        <input type="text" class="form-control" id="dni" placeholder="Número de documento" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Confirmar Pago</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
</html>