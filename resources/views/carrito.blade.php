<!-- resources/views/carrito.blade.php -->
@extends('layouts.layout')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container-fluid">
    <!-- Primera fila: Título y descripción -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="card shadow p-3">
                <h2 class="fw-bold">Confirma tu pedido</h2>
                <h5 class="tex-color">Verifica el pedido, selecciona el método de pago y finalmente de clic en confirmar y pagar.</h5>
            </div>
        </div>
    </div>
    <!-- Segunda fila: Detalle del pedido y método de pago -->
    <div class="row">
        <!-- Detalle del pedido -->
        <div class="col-md-8">
            <div class="card shadow p-3">
                <h5 class="fw-bold">Detalle</h5>
                <template x-if="carrito.length === 0">
                    <p class="text-center text-muted">Tu carrito está vacío</p>
                </template>
                <template x-for="(producto, index) in carrito" :key="producto.id">
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img :src="producto.imagen" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1" x-text="producto.nombre"></h6>
                            <p class="small text-muted" x-text="producto.detalles"></p>
                            <p class="fw-bold mb-0">$<span x-text="producto.precio"></span></p>
                        </div>
                        <button class="btn btn-transparent btn-sm me-2" @click="editarProducto(index)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-transparent btn-sm" @click="eliminarDelCarrito(index)">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </template>
                <div class="text-end mt-3">
                    <h5 class="fw-bold">TOTAL: $<span x-text="totalCarrito"></span></h5>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <button class="btn btn-transparent" @click="agregarMasProductos">Agregar más productos</button>
                </div>
            </div>
        </div>

        <!-- Método de pago -->
        <div class="col-md-4">
            <div class="card shadow p-3" x-data="{ metodoSeleccionado: '' }">
                <h5 class="fw-bold">Método de Pago</h5>
                <div class="d-flex flex-column gap-4 my-3">
                    <label class="d-flex align-items-center gap-2 text-color"
                        :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'PSE' }">
                        <input type="radio" name="metodoPago" value="PSE" class="form-check-input" x-model="metodoSeleccionado">
                        <img src="{{ asset('images/icons/pse.svg') }}" width="30" alt="PSE"> PSE
                    </label>

                    <label class="d-flex align-items-center gap-2 text-color"
                        :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Bancolombia' }">
                        <input type="radio" name="metodoPago" value="Bancolombia" class="form-check-input" x-model="metodoSeleccionado">
                        <img src="{{ asset('images/icons/bancolombia.svg') }}" width="30" alt="Bancolombia"> Bancolombia
                    </label>

                    <label class="d-flex align-items-center gap-2 text-color"
                        :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Nequi' }">
                        <input type="radio" name="metodoPago" value="Nequi" class="form-check-input" x-model="metodoSeleccionado">
                        <img src="{{ asset('images/icons/nequi.svg') }}" width="30" alt="Nequi"> Nequi
                    </label>

                    <label class="d-flex align-items-center gap-2 text-color"
                        :class="{ 'shadow p-2 rounded': metodoSeleccionado === 'Binance' }">
                        <input type="radio" name="metodoPago" value="Binance" class="form-check-input" x-model="metodoSeleccionado">
                        <img src="{{ asset('images/icons/binance.svg') }}" width="30" alt="Binance"> Binance
                    </label>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <button class="btn btn-transparent" @click="confirmarPago">Confirmar y pagar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection