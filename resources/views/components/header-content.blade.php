<div>
    <div class="container-fluid d-flex flex-column flex-grow-1">
        <!-- Row superior: Logo -->
        <div class="row">
            <div class="col-4 text-start">
                <img src="{{ asset('images/logos/logoCalculadora.svg') }}" alt="Logo">
            </div>
        </div>
        <!-- Título central -->
        <div class="row align-items-center mb-4">
            <!-- Título -->
            <div class="col-12 text-center">
                <h3 class="fw-bold">Transferencias a Venezuela</h3>
            </div>
        </div>
        <!-- Row central: Dólar oficial y tasa -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="d-flex justify-content-evenly align-items-center text-color" x-data="calculadora()">
                    <!-- TASA -->
                    <div>
                        <label for="tasa" class="d-block text-center">TASA</label>
                        <input id="tasa" type="text" class="form-control text-center mx-auto" x-model.number="tasa" readonly style="max-width: 100px;">
                    </div>
                    <!-- Dólar Oficial -->
                    <div>
                        <label for="oficial" class="d-block text-center">Dólar Oficial</label>
                        <input id="oficial" type="text" class="form-control text-center mx-auto" x-bind:value="oficial" readonly style="max-width: 100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
