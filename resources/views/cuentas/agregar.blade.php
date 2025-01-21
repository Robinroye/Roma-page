@extends('layouts.layout')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Agregar Nueva Cuenta</h2>
    
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
    numeroWhatsapp="{{ $numeroWhatsapp }}"
    nombreTitular="{{ old('nombre_titular') }}"
    tipoDocumento="{{ old('tipo_documento') }}"
    numeroDocumento="{{ old('numero_documento') }}"
    numeroCuenta="{{ old('numero_cuenta') }}"
    pagoMovil="{{ old('pago_movil') }}"
    submitText="Guardar Cuenta"
    cancelRoute="{{ route('cuentas', ['numero_whatsapp' => $numeroWhatsapp]) }}"
/>

</div>
@endsection
