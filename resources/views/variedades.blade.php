@extends('layouts.layout')

@section('title', 'Variedades')

@section('content')
<div x-data="detalleProducto()">
    <div class="container-fluid">
        <div class="row">
            @foreach ($productos as $producto)
            <div class="col-md-3 mb-3" id="item-{{ $producto['id'] }}">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-center align-items-center p-2">
                        <!-- Carrusel dinámico -->
                        <div id="carousel-{{ $producto['id'] }}" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach ($producto['imagenes'] as $index => $imagen)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $imagen }}" class="d-block w-100" alt="Imagen {{ $index + 1 }} de {{ $producto['nombre'] }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $producto['id'] }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $producto['id'] }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                            <button class="btn btn-sm btn-transparent position-absolute bottom-0 end-0 m-2 z-2"
                                data-bs-toggle="modal"
                                data-bs-target="#detalleProductoModal"
                                @click="cargarDetalle({{ $producto['id'] }})">
                                Ver más
                            </button>
                        </div>
                    </div>
                    <div class="card-footer text-color">
                        <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                        <p class="card-text">Precio: ${{ number_format($producto['precio'], 0, ',', '.') }}</p>
                        <div class="d-flex justify-content-between">
                            <input type="number" autocomplete="off" class="form-control form-control-sm w-50" placeholder="Cantidad">
                            <a @click="addToCart('variedad', {
    id: {{ $producto['id'] }},
    nombre: '{{ $producto['nombre'] }}',
    precio: '{{ $producto['precio'] }}',
    imagen: '{{ $producto['imagenes'][0] }}',
    cantidad: $el.parentElement.querySelector('input').value || 1
})">
                                <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito" width="20">
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal de detalle de producto -->
    <div class="modal fade" id="detalleProductoModal" tabindex="-1" aria-labelledby="detalleProductoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleProductoLabel" x-text="producto.nombre"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Carrusel para imágenes en el modal -->
                            <div id="detalleCarousel" class="carousel slide">
                                <div class="carousel-inner">
                                    <template x-for="(imagen, index) in producto.imagenes" :key="index">
                                        <div class="carousel-item" :class="{ 'active': index === 0 }">
                                            <img :src="imagen" class="d-block w-100 img-fluid rounded" alt="Imagen del producto">
                                        </div>
                                    </template>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#detalleCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#detalleCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mt-2"><strong>Descripción:</strong></p>
                            <p x-text="producto.descripcion"></p>
                            <p><strong>Precio:</strong> $<span x-text="producto.precio"></span></p>
                            <div class="d-flex align-items-center mt-3">
                                <input type="number" autocomplete="off" class="form-control w-50 me-2" placeholder="Cantidad">
                                <button class="btn btn-transparent btn-sm" @click="addToCart('variedad', {
    id: producto.id,
    nombre: producto.nombre,
    precio: producto.precio,
    imagen: producto.imagenes[0],
    cantidad: $el.parentElement.querySelector('input').value || 1
})">Agregar al carrito
                                    <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito" width="20">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection