@extends('layouts.layout')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container-fluid d-flex flex-column flex-grow-1 mb-2">
    <!-- Row superior: Título y Tasa -->
    <div class="row align-items-center">
        <div class="col-6 text-start">
            <img src="{{ asset('images/logos/logoCalculadora.svg') }}" alt="Logo">
        </div>
    </div>
    <!-- Título central -->
    <div class="mb-3 text-center">
        <h3 class="fw-bold">Transferencia a Venezuela</h3>
    </div>
    <!-- Row central: Dólar oficial y tasa-->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="d-flex justify-content-evenly align-items-center" x-data="calculadora()">
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
    <!-- Row central: Formulario para ingresar datos -->
    <div class="row">
        <div class="col-6">
            <div class="input-group">
                <legend class="fs-5">
                    Ingrese su número de WhatsApp y luego de clic en la lupa
                </legend>
                <input type="text" class="form-control" placeholder="300 667 00 97">
                <a href="{{ route('sin-cuentas') }}" class="btn btn-transparent">
                    <i class="fa fa-search"></i>
                </a>
            </div>
            <!-- Mensaje al usuario -->
            <p class="text-center text-danger">
                El número de WhatsApp ingresado no tiene cuentas asociadas. Ingrese los datos de la cuenta y luego haga clic en GUARDAR.
            </p>
        </div>
        <div class="col-md-6 text-color">
            <div class="card border-0 shadow-sm p-4">
                <!-- Formulario -->
                <form action="{{ route('guardar-cuenta') }}" method="POST">
                    @csrf <!-- Esto es importante para proteger contra ataques CSRF -->

                    <div class="mb-3 text-color">
                        <label for="nombre_titular" class="form-label">Nombre titular</label>
                        <input type="text" id="nombre_titular" name="nombre_titular" class="form-control" required>
                    </div>

                    <div class="mb-3 text-color">
                        <label for="tipo_documento" class="form-label">Tipo documento</label>
                        <select id="tipo_documento" name="tipo_documento" class="form-control" required>
                            <option value="V">V</option>
                            <option value="Ext">Ext</option>
                            <option value="J">J</option>
                        </select>
                    </div>

                    <div class="mb-3 text-color">
                        <label for="numero_documento" class="form-label">Número documento</label>
                        <input type="number" id="numero_documento" name="numero_documento" class="form-control" required>
                    </div>

                    <div class="mb-3 text-color">
                        <label for="numero_cuenta" class="form-label">Número cuenta</label>
                        <input type="number" id="numero_cuenta" name="numero_cuenta" class="form-control" required>
                    </div>

                    <div class="mb-3 text-color">
                        <label for="pago_movil" class="form-label">Pago móvil</label>
                        <input type="text" id="pago_movil" name="pago_movil" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-transparent">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection