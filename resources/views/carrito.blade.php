<!-- resources/views/carrito.blade.php -->
@extends('layouts.layout')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container-fluid">
        <div x-data="carrito" x-init="init()">
            <!-- Primera fila: Título y descripción -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="card shadow p-3">
                        <h2 class="fw-bold">Confirma tu pedido</h2>
                        <h5 class="tex-color">Verifica el pedido, selecciona el método de pago y finalmente de clic en
                            confirmar y pagar.</h5>
                    </div>
                </div>
            </div>
            <!-- Segunda fila: Detalle del pedido y método de pago -->
            <div class="row">
                <!-- Detalle del pedido -->
                <div class="col-md-8 mb-2">
                    <div class="card shadow p-3">
                        <h5 class="fw-bold">Detalle</h5>
                        <template x-if="carrito.length === 0">
                            <p class="text-center text-muted">Tu carrito está vacío</p>
                        </template>
                        <template x-for="(producto, index) in carrito" :key="producto.id">
                            <div x-data="{ editing: true }">
                                <template x-if="producto.tipo === 'variedad'">
                                    <div class="d-flex align-items-center border-bottom py-3" x-data="{ cantidadVariedad: producto.cantidad }">
                                        <img :src="producto.imagen" class="img-thumbnail me-3"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <span x-text="producto.nombre"></span>
                                                <b> x
                                                    <input type="number" class="form-control d-inline w-25 text-center"
                                                        min="1" x-model="cantidadVariedad"
                                                        @input="guardarEdiciones(index, 'variedades')">
                                                </b>
                                            </h6>
                                            <p class="small text-muted" x-text="producto.detalles"></p>
                                            <p class="fw-bold mb-0">$<span
                                                    x-text="producto.precio * cantidadVariedad"></span></p>
                                        </div>
                                        <button class="btn btn-transparent btn-sm" @click="eliminarDelCarrito(index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="producto.tipo === 'impresion'">
                                    <div class="d-flex flex-column border-bottom py-3" x-data="{ cantidadImpresion: producto.cantidad }">
                                        <div class="d-flex align-items-center">
                                            <img class="img-thumbnail me-3"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">
                                                    <span>Impresión</span>
                                                    <b> x
                                                        <input type="number" class="form-control d-inline w-25 text-center"
                                                            min="1" x-model="cantidadImpresion"
                                                            @input="guardarEdiciones(index, 'impresion')">
                                                    </b>
                                                </h6>
                                                <p class="small text-muted" x-text="producto.detalles"></p>
                                                <p class="fw-bold mb-0">$<span
                                                        x-text="producto.precio * cantidadImpresion"></span></p>
                                            </div>
                                            <button class="btn btn-transparent btn-sm" @click="eliminarDelCarrito(index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div x-bind:id="'accordion' + producto.id" class="accordion w-100 mt-2 collapsed">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        x-bind:data-bs-target="'#accordion' + producto.id + '_item'"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        Detalles
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse"
                                                    x-bind:id="'accordion' + producto.id + '_item'" aria-labelledby="headingOne"
                                                    x-bind:data-bs-parent="'#accordion' + producto.id">
                                                    <div class="accordion-body">
                                                        <p><strong>Papel: </strong><span
                                                                x-text="producto.impresion_papel"></span></p>
                                                        <p><strong>Color: </strong><span
                                                                x-text="producto.impresion_color"></span></p>
                                                        <p><strong>Caras: </strong><span
                                                                x-text="producto.impresion_caras"></span></p>
                                                        <p><strong>Paginas a imprimir: </strong><span
                                                                x-text="producto.impresion_paginas_a_imprimir"></span></p>
                                                        <p><strong>Paginas: </strong><span
                                                                x-text="producto.impresion_paginas_totales"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="producto.tipo === 'giro'">
                                    <div class="d-flex flex-column border-bottom py-3" x-data="calculadora()">
                                        <div class="d-flex align-items-center" x-init="bss = producto.monto_bss;
                                        dolares = producto.monto_dolares;
                                        cop = producto.monto_cop">
                                            <img :src="producto.imagen" class="img-thumbnail me-3"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Giro</h6>
                                                <p class="small text-muted" x-text="producto.detalles"></p>
                                                <p class="fw-bold mb-0">$<span x-text="producto.precio"></span></p>
                                            </div>
                                            <button class="btn btn-transparent btn-sm" @click="eliminarDelCarrito(index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div x-bind:id="'accordion' + producto.id" class="accordion w-100 mt-2 collapsed">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        x-bind:data-bs-target="'#accordion' + producto.id + '_item'"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Detalles
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse"
                                                    x-bind:id="'accordion' + producto.id + '_item'" aria-labelledby="headingOne"
                                                    x-bind:data-bs-parent="'#accordion' + producto.id">
                                                    <div class="accordion-body">
                                                        <p><strong>Titular: </strong><span
                                                                x-text="producto.nombre_titular"></span></p>
                                                        <p><strong>Tipo de Documento: </strong><span
                                                                x-text="producto.tipo_documento"></span></p>
                                                        <p><strong>Cuenta: </strong><span
                                                                x-text="producto.numero_cuenta"></span></p>
                                                        <p><strong>Pago Móvil: </strong><span
                                                                x-text="producto.pago_movil"></span></span></p>
                                                        <div>
                                                            <p><strong>BSS: </strong><input type="number"
                                                                    class="form-control d-inline w-25 text-center"
                                                                    min="1" x-model.number="bss"
                                                                    @input="guardarEdiciones(index, 'giro', 'bss')"></span>
                                                            </p>
                                                            <p><strong>Dólares: </strong><input type="number"
                                                                    class="form-control d-inline w-25 text-center"
                                                                    min="1" x-model.number="dolares"
                                                                    @input="guardarEdiciones(index, 'giro', 'dolares')"></span>
                                                            </p>
                                                            <p><strong>Pesos Colombianos: </strong><input type="number"
                                                                    class="form-control d-inline w-25 text-center"
                                                                    min="1" x-model.number="cop"
                                                                    @input="guardarEdiciones(index, 'giro', 'cop')"></span>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <div class="text-end mt-3">
                            <h5 class="fw-bold">TOTAL: $<span x-text="totalCarrito"></span></h5>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <button class="btn btn-transparent" @click="agregarMasProductos">Agregar más
                                productos</button>
                        </div>
                    </div>
                </div>

                <!-- Método de pago -->
                <div class="col-md-4 ">
                    <div class="card shadow p-3" x-data="{ metodoSeleccionado: '' }">
                        <h5 class="fw-bold">Método de Pago</h5>
                        <div class="d-flex flex-column gap-4 my-3">
                            <label class="d-flex align-items-center gap-2 text-color"
                                :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'PSE' }">
                                <input type="radio" name="metodoPago" value="PSE" class="form-check-input"
                                    x-model="metodoSeleccionado">
                                <img src="{{ asset('images/icons/pse.svg') }}" width="30" alt="PSE"> PSE
                            </label>

                            <label class="d-flex align-items-center gap-2 text-color"
                                :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Bancolombia' }">
                                <input type="radio" name="metodoPago" value="Bancolombia" class="form-check-input"
                                    x-model="metodoSeleccionado">
                                <img src="{{ asset('images/icons/bancolombia.svg') }}" width="30" alt="Bancolombia">
                                Bancolombia
                            </label>

                            <label class="d-flex align-items-center gap-2 text-color"
                                :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Nequi' }">
                                <input type="radio" name="metodoPago" value="Nequi" class="form-check-input"
                                    x-model="metodoSeleccionado">
                                <img src="{{ asset('images/icons/nequi.svg') }}" width="30" alt="Nequi"> Nequi
                            </label>

                            <label class="d-flex align-items-center gap-2 text-color"
                                :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Binance' }">
                                <input type="radio" name="metodoPago" value="Binance" class="form-check-input"
                                    x-model="metodoSeleccionado">
                                <img src="{{ asset('images/icons/binance.svg') }}" width="30" alt="Binance"> Binance
                            </label>
                        </div>
                        <div class="mt-4">
                            <input type="text" x-model="userPhone" placeholder="Tu número de celular" class="form-control mb-2">
                            <button class="btn btn-transparent w-100" @click="enviarPedido(userPhone)">Confirmar Pedido</button>
                        </div>
                        {{-- <div class="d-flex justify-content-between mb-2">
                            <button class="btn btn-transparent" @click="confirmarPago">Confirmar y pagar</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
