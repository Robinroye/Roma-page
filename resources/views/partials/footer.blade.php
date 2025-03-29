<!-- Footer -->
<footer class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Left Column -->
            <div class="col-md-4 text-start">
                <a href="#" class="text-decoration-none me-2" data-bs-toggle="modal" data-bs-target="#condicionesModal">
                    Condiciones de uso
                </a> |
                <a href="#" class="text-decoration-none ms-2" data-bs-toggle="modal" data-bs-target="#privacidadModal">
                    Aviso de Privacidad
                </a>
                <p class="mt-2 mb-0">&copy; 2024 Roma Servicios</p>
            </div>

            <!-- Center Column -->
            <div class="col-md-4 text-start">
                <a href=https://maps.app.goo.gl/m8Jwzhvm539UNPCX7
                    class="text-decoration-none"
                    target="_blank">
                    Calle 23 #55b-25 San Antonio de Pereira <br>Rionegro, Antioquia
                </a>
            </div>
            <!-- Right Column -->
            <div class="col-md-4 text-end">
                <a href="https://www.tiktok.com/@roma6189" target="_blank" class="text-decoration-none me-3">
                    <img src="{{ asset('images/icons/tiktok.svg') }}" alt="Tiktok.svg">
                </a>
                <a href="https://www.instagram.com/romaserviciossas" target="_blank" class="text-decoration-none me-3">
                    <img src="{{ asset('images/icons/instagram.svg') }}" alt="instagram.svg">
                </a>
                <a href="https://wa.me/573006670097" target="_blank" class="text-decoration-none">
                    <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp.svg">
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Modal Condiciones de Uso -->
<div class="modal fade" id="condicionesModal" tabindex="-1" aria-labelledby="condicionesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCondicionesLabel">Condiciones de Uso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Al acceder y utilizar este sitio web, el usuario acepta cumplir con los presentes términos y condiciones de uso. Si no está de acuerdo con alguna parte, debe abstenerse de usar el sitio.</p>

                <h6>1. Uso del sitio</h6>
                <p>El usuario se compromete a utilizar este sitio únicamente para fines legales y de acuerdo con estas condiciones, <br> Está prohibido: <br>

                    -Publicar contenido ofensivo, ilegal o dañino. <br>
                    -Intentar acceder sin autorización a áreas restringidas. <br>
                    -Utilizar este sitio para actividades fraudulentas o engañosas.</p>

                <h6>2. Propiedad intelectual</h6>
                <p>Todo el contenido del sitio, incluyendo imágenes, textos y logotipos, es propiedad de Roma Servicios o de sus respectivos titulares y está protegido por derechos de autor. No está permitida la reproducción sin autorización.</p>

                <h6>3. Privacidad y datos personales</h6>
                <p>El tratamiento de datos personales se realiza conforme a nuestra <a href="#" data-bs-toggle="modal" data-bs-target="#modalPrivacidad">Política de Privacidad</a>. No compartimos información con terceros sin consentimiento.</p>

                <h6>4. Responsabilidad y garantías</h6>
                <p>Nos esforzamos por ofrecer información precisa, pero Roma Servicios no se hace responsable de: <br>
                    -Errores o inexactitudes en la información publicada. <br>
                    -Fallos técnicos o interrupciones del servicio. <br>
                    -Daños causados por el uso del sitio.
                <h6>5. Modificaciones</h6>
                <p>Nos reservamos el derecho de actualizar o modificar estas condiciones en cualquier momento. Se recomienda revisarlas periódicamente.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Aviso de Privacidad -->
<div class="modal fade" id="privacidadModal" tabindex="-1" aria-labelledby="privacidadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacidadLabel">Aviso de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p>Roma Servicios, con dirección en Rionegro Antioquia, es responsable del tratamiento de los datos personales recopilados en este sitio web.</p>
                <ul>
                    <li>No compartimos tu información con terceros sin tu consentimiento.</li>
                    <li>Tus datos están protegidos mediante estándares de seguridad.</li>
                    <li>Puedes solicitar la eliminación de tu información en cualquier momento.</li>
                </ul>
            </div>
        </div>
    </div>
</div>