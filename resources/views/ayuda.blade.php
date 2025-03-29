@extends('layouts.layout')

@section('title', 'Ayuda')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Centro de Ayuda</h1>

    <div class="accordion" id="faqAccordion">
        <!-- Pregunta 1 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    📍 ¿Dónde están ubicados?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nos encuentras en **Calle 23 #55b-25, San Antonio de Pereira, Rionegro, Antioquia**. Puedes ver nuestra ubicación en <a href="https://maps.app.goo.gl/m8Jwzhvm539UNPCX7" target="_blank">Google Maps</a>.
                </div>
            </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    🖨️ ¿Qué servicios de impresión ofrecen?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ofrecemos impresiones en blanco y negro tamaño carta y oficio, a color solo tamaño carta. También realizamos impresiones en papel bond, propalcote 120gr, adhesivo, opalina, fotografico 220gr y holografico adhesivo. <a href="/impresion">Ver más</a>.
                </div>
            </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    🛒 ¿Cómo puedo hacer un pedido?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Puedes hacer tu pedido directamente en nuestra tienda en línea agregando los productos al carrito y finalizando la compra, o visitándonos en nuestra sede. Si tienes dudas, contáctanos por <a href="https://wa.me/573006670097" target="_blank">WhatsApp</a>.
                </div>
            </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    ⏳ ¿Cuánto tiempo tardan los pedidos?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    El tiempo de entrega varía según el servicio. Las impresiones regulares se entregan en horas para el area local o de un dia para otro a nivel nacional, mientras que pedidos especiales pueden tardar más. Contáctanos para más detalles.
                </div>
            </div>
        </div>

        <!-- Pregunta 5 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    💳 ¿Qué métodos de pago aceptan?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Aceptamos pagos en efectivo, tarjetas de crédito, débito y transferencias electrónicas. También puedes pagar a través de **Nequi, Bancolombia, PSE, Payu**.
                </div>
            </div>
        </div>

        <!-- Pregunta 6 -->
        <div class="accordion-item text-color">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed text-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    📦 ¿Tienen servicio de envío?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sí, ofrecemos servicio de entrega en Rionegro y municipios cercanos en el mismo dia, ten encuenta que pedidos realizados despues de las 3pm quedan para el siguiente dia, para  Consulta de costos y disponibilidad en la sección de envíos.
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4 text-color">
        <p>¿Tienes más preguntas? Contáctanos por <a href="https://wa.me/573006670097" target="_blank">WhatsApp</a> o por <a href="mailto:info.romaservicios@gmail.com">correo electrónico</a>.</p>
    </div>
</div>
@endsection
