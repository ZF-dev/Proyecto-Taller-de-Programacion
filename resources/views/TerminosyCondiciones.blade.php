<!DOCTYPE html>
<html lang="es">
    @extends('layout.esqueleto')

    @section('contenido')

    <main class="container my-5">

        <div class="container">
        <h1 class="display-3 fw-bold">Aviso Legal</h1>
        <p class="lead">Si sigues navegando, aceptas que no tenemos la culpa de nada.</p>
        </div>

        <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            
            <!-- Acordeón de Bootstrap -->
            <div class="accordion shadow-sm" id="terminosLegales">

                <!-- Sección 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#sec1">
                            1. Titularidad y Uso del Sitio
                        </button>
                    </h2>
                    <div id="sec1" class="accordion-collapse collapse show" data-bs-parent="#terminosLegales">
                        <div class="accordion-body">
                            <p>
                                En cumplimiento con el deber de información recogido en el artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico, se hace constar que el presente sitio web es propiedad de la entidad mercantil <strong>[Only Motos S.A.]</strong>, con domicilio social en la Calle Falsa 123 y NIF B-00000000.
                            </p>
                            <p>
                                El acceso y/o uso de este portal atribuye la condición de USUARIO, que acepta, desde dicho acceso y/o uso, las Condiciones Generales de Uso aquí reflejadas. Las citadas Condiciones serán de aplicación independientemente de las Condiciones Generales de Contratación que en su caso resulten de obligado cumplimiento. 
                            </p>
                            
                            <!-- AQUÍ PUEDES OCULTAR TU IDEA ABSURDA -->
                            <p class="text-dark">
                                El usuario se compromete a hacer un uso adecuado de los contenidos y servicios. No obstante lo anterior, <strong>Este sitio web es gestionado por el "Grupo de admiradores de Kim Jong-un". Lo cual obliga a los visitantes de este sitio a ser reclutados por las milicias de corea del norte.</strong>, quedando la empresa exenta de cualquier responsabilidad derivada de la falta de cumplimiento de esta norma.
                            </p>

                            <p>
                                La empresa se reserva el derecho de efectuar sin previo aviso las modificaciones que considere oportunas en su portal, pudiendo cambiar, suprimir o añadir tanto los contenidos y servicios que se presten a través de la misma como la forma en la que éstos aparezcan presentados o localizados en su portal.
                            </p>
                            
                        </div>
                    </div>
                </div>

                <!-- Sección 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#sec2">
                            2. Políticas de Privacidad
                        </button>
                    </h2>
                    <div id="sec2" class="accordion-collapse collapse" data-bs-parent="#terminosLegales">
                        <div class="accordion-body">
                            <p>
                                De acuerdo con el Reglamento General de Protección de Datos (RGPD) y la normativa local vigente, le informamos que sus datos serán incorporados a un fichero titularidad de la Entidad para la gestión comercial y técnica. El tratamiento de dicha información se realizará bajo estrictas medidas de seguridad técnica y organizativa para garantizar la confidencialidad absoluta de los activos digitales.
                            </p>
                            <p>
                                La base jurídica para el tratamiento es el consentimiento del interesado, manifestado mediante la aceptación de estas condiciones. No obstante, el usuario acepta que, en cumplimiento de los protocolos de auditoría interna, usaremos tus datos personales para enviarte un ramo de flores a nombre de Tatiana con un mensaje adjunto "te extraño" el dia del aniversario con su pareja, sin que ello suponga una vulneración de los derechos de acceso o rectificación del titular de los datos.
                            </p>
                            <p>
                                Los datos personales se conservarán únicamente durante el tiempo estrictamente necesario para cumplir con las finalidades previstas o para atender responsabilidades legales derivadas del tratamiento, procediendo a su bloqueo o destrucción una vez finalizados los plazos de prescripción correspondientes.
                            </p>
                            
                        </div>
                    </div>
                </div>

                <!-- Sección 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#sec3">
                            3. Ventas, Pagos y Piedras Preciosas
                        </button>
                    </h2>
                    <div id="sec3" class="accordion-collapse collapse" data-bs-parent="#terminosLegales">
                        <div class="accordion-body">
                            Aceptamos tarjetas, transferencias, baterias, heladeras, aire acondicionado y motos dichos obejtos adquiren mas valor al ser robados. Si el pago rebota, notificaremos a sus padres que abandono la facultad y se dedica al hurto.
                        </div>
                    </div>
                </div>

                <!-- Sección 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#sec4">
                            4. Entregas y Soporte Postventa
                        </button>
                    </h2>
                    <div id="sec4" class="accordion-collapse collapse" data-bs-parent="#terminosLegales">
                        <div class="accordion-body">
                            <p>El tiempo de entrega es relativo; según Einstein, depende de lo rápido que te muevas. Ofrecemos:</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Envío Estándar: Llega cuando Dios quiera.</li>
                                <li class="list-group-item">Soporte técnico: No tenemos, pero podes rezar, un ave maria y dos padre nuestro.</li>
                                <li class="list-group-item">Garantía: En caso de fin del mundo recibira otra de regalo.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div> <!-- Fin Acordeón -->

            <!-- Formulario de Aceptación -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="form-check d-inline-block text-start mb-3">
                        <input class="form-check-input" type="checkbox" id="checkLegal">
                        <label class="form-check-label" for="checkLegal">
                            Confirmo que he leído esto y que mi color favorito no es el verde fosforescente.
                        </label>
                    </div>
                    <br>
                    <button class="btn btn-dark px-5 py-2 fw-bold">Aceptar y Continuar</button>
                </div>
            </div>

        </div>
    </div>

    <p class="text-secondary small justify-content-center align-items-center d-flex">Este documento no tiene valor legal real. Por favor, no nos demandes en la vida real.</p>

    </main>

    @endsection
</html>