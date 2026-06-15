@extends('layout.esqueleto')

@section('title', 'Confirmación de Pago')

@section('contenido')
<div class="container mt-5 mb-5 text-center">
    <div class="p-5 bg-white shadow-sm rounded border border-light">
        <div class="text-success mb-3">
            <!-- Icono check de Bootstrap Icons por estética si lo usás, sino remover -->
            <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i> 
        </div>
        
        <h1 class="mb-3"><b>¡Operación Confirmada!</b></h1>
        
        @if(session('success'))
            <div class="alert alert-success d-inline-block px-4 mb-3">{{ session('success') }}</div>
        @endif

        <p class="fs-5 text-muted">¡Gracias por confiar en nosotros! Tu solicitud ha sido procesada con éxito por nuestro sistema.</p>
        <p class="small text-secondary">A la brevedad te enviaremos un correo electrónico con el resumen detallado y los pasos para el retiro o envío de tus unidades.</p>
        
        <div class="mt-4">
            <a href="/Catalogo" class="btn btn-primary px-4 py-2">Volver al Catálogo</a>
        </div>
    </div>
</div>
@endsection
