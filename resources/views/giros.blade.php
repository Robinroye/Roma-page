@extends('layouts.layout')

@section('title', 'Giros')

@section('content')
<div class="container-fluid d-flex flex-column flex-grow-1">
    <!-- Row superior: Logo -->
    <div class="row">
        <div class="col-4 text-start">
            <img src="{{ asset('images/logos/logoCalculadora.svg') }}" alt="Logo">
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <!-- Título -->
        <div class="col-12 text-center">
            <h3 class="fw-bold">Transferencias a Venezuela</h3>
        </div>
    </div>
    <!-- Row central: Dólar oficial y tasa-->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
                <div class="d-flex justify-content-evenly align-items-center text-color" x-data="calculadora()">
                    <!-- Dólar oficial -->
                    <div>
                        <label for="tasa" class="d-block text-center">TASA</label>
                        <input id="tasa" type="text" class="form-control text-center mx-auto" x-model.number="tasa" readonly style="max-width: 100px;">
                    </div>
                    <div>
                        <label for="oficial" class="d-block text-center">Dólar Oficial</label>
                        <input id="oficial" type="text" class="form-control text-center mx-auto" x-bind:value="oficial" readonly style="max-width: 100px;">
                    </div>
                    
                </div>
        </div>
    </div>

    <!-- Row inferior: Input de número de WhatsApp -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="input-group">
                <legend class="fs-5">
                    Ingrese su número de WhatsApp y luego de clic en la lupa
                </legend>
                <input type="text" class="form-control" placeholder="300 667 00 97">
                <a href="{{ route('sin-cuentas') }}" class="btn btn-transparent">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection