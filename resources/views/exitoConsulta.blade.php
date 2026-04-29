<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')
    <div class="container mt-4"> 
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Formulario Enviado con Exito</h1>
                <p class="lead">hemos recibido tu mensaje. Un miembro 
                del equipo de ventas se pondrá en contacto con vos al correo especificado !Muchas Gracias¡</p>
                <buttom class="btn btn-primary" onclick="window.location.href='/'">Continuar</buttom>
            </div>
        </div>
    </div>
    @endsection
</html> 