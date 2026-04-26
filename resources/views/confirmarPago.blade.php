<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('title', 'Confirmacion de Pago')

    @section('contenido')
    <div class="container mt-5 mb-5">
        <h1><b>Confirmación de Pago</b></h1>
        <p>¡Gracias por tu compra! Tu pago/solicitud ha sido procesado exitosamente.</p>
        <p>Recibirás un correo de confirmación con los detalles de tu pedido.</p>
        <a href="/Catalogo" class="btn btn-primary">Volver al Catálogo</a>
    </div>
    @endsection
</html>