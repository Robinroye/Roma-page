@extends('layouts.layout')

@section('title', 'Inicio | Roma Servicios')

@section('content')
<div class="container-fluid d-flex flex-column flex-grow-1">
    <!-- First Row -->
    <div class="row">
        <div class="col-md-6 position-relative d-flex align-items-center justify-content-center">
            <div class="d-flex flex-wrap justify-content-center text-color h-100 w-100 rounded">
                <div class="card text-color m-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <img src="{{ asset('images/logos/logoCalculadora.svg') }}" alt="logo text-color" style="height: 40px;">
                        <h3 class="m-4">CALCULADORA</h3>
                    </div>
                    <div class="card-body" x-data="calculadora()">
                        <!-- Row superior: Tasa y Dólar Oficial -->
                        <div class="row justify-content-center text-center mb-4">
                            <div class="col-6">
                                <div>
                                    <label for="tasa" class="d-block">TASA</label>
                                    <input id="tasa" type="text" class="form-control text-center mx-auto" x-model.number="tasa" readonly style="max-width: 100px;">
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label for="oficial" class="d-block">Dólar Oficial</label>
                                    <input id="oficial" type="text" class="form-control text-center mx-auto" x-bind:value="oficial" readonly style="max-width: 100px;">
                                </div>
                            </div>
                        </div>
                        <!-- Row central: Campos de conversión -->
                        <div class="mb-3">
                            <label for="dolares">USD / Dólar Americano</label>
                            <input id="dolares" type="number" class="form-control" x-model.number="dolares" x-on:input="convertir('dolares')">
                        </div>
                        <div class="mb-3">
                            <label for="bss">BSS / Bolívares</label>
                            <input id="bss" type="number" class="form-control" x-model.number="bss" x-on:input="convertir('bss')">
                        </div>
                        <div>
                            <label for="cop">COP / Pesos Colombianos</label>
                            <input id="cop" type="number" class="form-control" x-model.number="cop" x-on:input="convertir('cop')">
                        </div>
                    </div>
                    <div class="card-footer text-start">
                        <p>Calculos con referencia al dolar oficial de Venezuela.</p>
                    </div>
                </div>
                <a href="{{ route('giros') }}" class="btn position-absolute bottom-0 end-0 m-3 btn-transparent">
                    Ver más
                </a>
            </div>
        </div>
        <!-- Carrusel (Columna Derecha) -->
        <div class="col-md-6 position-relative d-flex align-items-center justify-content-center p-2"
            x-data="{
                imagenes: [
            '{{ asset('images/carousel/1.svg') }}',
            '{{ asset('images/carousel/2.svg') }}',
            '{{ asset('images/carousel/3.svg') }}',
            '{{ asset('images/carousel/4.svg') }}'
                ],
                links: {
            '{{ asset('images/carousel/1.svg') }}': '/impresion',
            '{{ asset('images/carousel/2.svg') }}': '/variedades',
            '{{ asset('images/carousel/3.svg') }}': '/plotter',
            '{{ asset('images/carousel/4.svg') }}': '/otra-seccion'
                },
            activeIndex: 0,
            updateIndex(event) {
                this.activeIndex = event.to;
            }
            }"
            x-init="
                let carousel = $refs.carousel;
                carousel.addEventListener('slid.bs.carousel', event => updateIndex(event));
            ">
            <div id="carouselExampleIndicators" class="carousel slide w-100 rounded" data-bs-ride="carousel"
                x-ref="carousel">
                <div class="carousel-indicators">
                    <template x-for="(img, index) in imagenes" :key="index">
                        <button type="button"
                            data-bs-target="#carouselExampleIndicators"
                            :data-bs-slide-to="index"
                            :class="index === activeIndex ? 'active' : ''"
                            :aria-label="'Slide ' + (index + 1)">
                        </button>
                    </template>
                </div>
                <div class="carousel-inner">
                    <template x-for="(img, index) in imagenes" :key="index">
                        <div class="carousel-item" :class="{ 'active': index === activeIndex }">
                            <img :src="img" class="d-block w-100" alt="Imagen del carrusel">
                        </div>
                    </template>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
            <button class="btn position-absolute bottom-0 end-0 m-3 btn-transparent"
                @click="window.location.href = links[imagenes[activeIndex]]">
                Ver más
            </button>
        </div>
    </div>
    <!-- Second Row -->
    <div class="row">
        @php
        // Mapeo de imágenes a sus respectivas URLs
        $links = [
        'Frame1.svg' => 'https://maps.app.goo.gl/m8Jwzhvm539UNPCX7', // Google Maps
        'Frame2.svg' => route('impresion'), // Ruta a Impresiones
        'Frame3.svg' => route('variedades'), // Ruta a Variedades
        'Frame4.svg' => route('plotter'), // Ruta a Plotter
        ];
        @endphp

        <div class="row">
            @foreach ($links as $img => $url)
            <div class="col-12 col-md-6 col-lg-3 position-relative d-flex align-items-center justify-content-center mb-2">
                <img src="{{ asset("images/fixed/$img") }}" class="img-fluid w-100" alt="Imagen fija">
                <a href="{{ $url }}"
                    class="btn position-absolute bottom-0 end-0 m-3 btn-transparent"
                    @if (Str::startsWith($url, 'https://maps.app.goo.gl/m8Jwzhvm539UNPCX7' )) target="_blank" @endif>
                    Ver más
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection