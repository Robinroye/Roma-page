@extends('layouts.layout')

@section('title', 'Inicio | Roma Servicios')

@section('content')
<div class="container-fluid vh-100 d-flex flex-column">
    <!-- First Row -->
    <div class="row flex-grow-1" style="height: 60%;">
        <!-- Left Column -->
        <div class="col-md-6 d-flex flex-column align-items-start justify-content-center bg-light p-4">
            <h2>Calculadora de Conversión</h2>
            <p>Convierte entre BSS, COP y USD fácilmente.</p>
            <!-- Aquí irá la calculadora -->
            <button class="btn btn-primary mt-auto align-self-end">Ver más</button>
        </div>

        <!-- Right Column -->
        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center bg-secondary p-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/carousel/1.svg') }}" class="d-block w-100" alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousel/2.svg') }}" class="d-block w-100" alt="Imagen 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousel/3.svg') }}" class="d-block w-100" alt="Imagen 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousel/4.svg') }}" class="d-block w-100" alt="Imagen 4">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <button class="btn btn-primary mt-auto align-self-end">Ver más</button>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row flex-grow-0" style="height: 40%;">
        @foreach (['Frame1.svg', 'Frame2.svg', 'Frame3.svg', 'Frame4.svg'] as $img)
        <div class="col-md-3 d-flex flex-column align-items-center justify-content-center bg-light p-3">
            <img src="{{ asset("images/fixed/$img") }}" class="img-fluid mb-3" alt="Imagen fija">
            <button class="btn btn-primary mt-auto align-self-end">Ver más</button>
        </div>
        @endforeach
    </div>
</div>
@endsection