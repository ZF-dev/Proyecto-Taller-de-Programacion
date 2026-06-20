@extends('layout.esqueleto')

@section('title', 'Términos y Condiciones - Only Motos')

@section('contenido')

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="display-5 fw-bold text-dark mb-4">Términos, Condiciones y Políticas de Privacidad</h1>
                    <p class="text-muted small">Documento de cumplimiento legal para el usuario y consumidor.</p>
                    
                    <hr class="my-4">

                    <section class="mb-5">
                        <h4 class="fw-bold text-primary">1. Aviso Legal y Términos de Uso</h4>
                        <p class="text-secondary text-justify">
                            El acceso y uso de este sitio web atribuye la condición de usuario e implica la aceptación de las presentes condiciones. El usuario se compromete a utilizar los servicios de <strong>Only Motos</strong> exclusivamente para fines lícitos, quedando prohibida cualquier acción que pueda dañar, inutilizar o sobrecargar la infraestructura del sitio.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold text-primary">2. Políticas de Privacidad</h4>
                        <p class="text-secondary">
                            De acuerdo con la normativa de protección de datos, le informamos que sus datos personales son tratados con el fin de gestionar las solicitudes de información, ventas y servicios postventa. Only Motos garantiza que no cederá sus datos a terceros sin consentimiento previo, salvo obligación legal o necesidad técnica para la gestión del seguro o patentamiento de la unidad.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold text-primary">3. Procedimiento de Venta y Medios de Pago</h4>
                        <p class="text-secondary">
                            La comercialización de productos se formaliza mediante factura fiscal. Los precios publicados están sujetos a variaciones de mercado. Se aceptan pagos vía transferencia bancaria, tarjetas de crédito (bajo programas de financiación vigentes) y créditos prendarios, los cuales están sujetos a la aprobación de la entidad financiera externa.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold text-primary">4. Garantías y Soporte Postventa</h4>
                        <p class="text-secondary">
                            <strong>Garantía:</strong> Todas las unidades 0km cuentan con la garantía oficial del fabricante (los plazos varían según la marca). <br>
                            <strong>Soporte Postventa:</strong> Only Motos ofrece un canal de soporte técnico y asesoramiento para el mantenimiento preventivo. El cumplimiento de los servicios programados en talleres autorizados es requisito indispensable para mantener la vigencia de la garantía.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold text-primary">5. Formas de Entrega y Tiempos Estimados</h4>
                        <ul class="text-secondary">
                            <li><strong>Retiro en Sucursal:</strong> Sin costo, una vez finalizado el proceso de patentamiento (est. 48-72hs hábiles).</li>
                            <li><strong>Envío a Domicilio:</strong> Realizado a través de logística especializada en transporte de motos.</li>
                            <li><strong>Tiempos:</strong> Los envíos nacionales tienen un tiempo estimado de 5 a 10 días hábiles dependiendo de la zona geográfica y el tipo de servicio contratado (Normal o Express).</li>
                        </ul>
                    </section>

                    <div class="bg-dark text-white p-4 rounded-3 text-center">
                        <p class="mb-0 small">
                            Al confirmar una operación comercial con Only Motos, el cliente declara haber leído y aceptado los puntos anteriores en su totalidad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
 @endsection