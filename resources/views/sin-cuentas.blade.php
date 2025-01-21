@extends('layouts.layout')

@section('content')
<!-- Row superior: Título y Tasa -->
<x-header-content />
<div class="container-fluid d-flex flex-column flex-grow-1 mb-2">
    <!-- Row central: Formulario para ingresar datos -->
    <div class="row">
        <div class="col-md-6">
            <x-input-search />
            <!-- Mensaje al usuario -->
            <p class="text-center text-danger">
                El número de WhatsApp ingresado no tiene cuentas asociadas. Ingrese los datos de la cuenta y luego haga clic en GUARDAR.
            </p>
        </div>
        <div class="col-md-6 text-color">
            <div class="card border-0 shadow-sm p-4">
                <!-- Formulario -->
                <p>El número de WhatsApp ingresado <strong>{{ session('numero_whatsapp') }}</strong> no tiene cuentas asociadas.</p>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <x-form-cuenta
                    action="{{ route('guardar-cuenta') }}"
                    numeroWhatsapp="{{ session('numero_whatsapp') }}"
                    submitText="Guardar" 
                />

            </div>
        </div>
    </div>
</div>
@endsection