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
                        <p>Estos datos son valores aproximados.</p>
                    </div>
                </div>

                <button class="btn position-absolute bottom-0 end-0 m-3 btn-transparent">Ver más</button>
            </div>
        </div>

        <!-- Carrusel (Columna Derecha) -->
        <div class="col-md-6 position-relative d-flex align-items-center justify-content-center p-2">
            <div id="carouselExampleIndicators" class="carousel slide w-100 rounded" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    @foreach (['1.svg', '2.svg', '3.svg', '4.svg'] as $index => $img)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <img src="{{ asset("images/carousel/$img") }}" class="d-block w-100" alt="Imagen del carrusel">
                    </div>
                    @endforeach
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
            <button class="btn position-absolute bottom-0 end-0 m-3 btn-transparent">Ver más</button>
        </div>
        <!-- Aquí va la calculadora -->
    </div>
    <!-- Second Row -->
    <div class="row">
        @foreach (['Frame1.svg', 'Frame2.svg', 'Frame3.svg', 'Frame4.svg'] as $img)
        <div class="col-12 col-md-6 col-lg-3 position-relative d-flex align-items-center justify-content-center mb-2">
            <img src="{{ asset("images/fixed/$img") }}" class="img-fluid w-100" alt="Imagen fija">
            <button class="btn position-absolute bottom-0 end-0 m-3 btn-transparent">Ver más</button>
        </div>
        @endforeach
    </div>
</div>
@endsection