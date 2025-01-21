@extends('layouts.layout')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Editar Cuenta</h2>

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
    action="{{ route('actualizar-cuenta', ['id' => $cuenta->id]) }}" 
    method="PUT"
    numeroWhatsapp="{{ $cuenta->numero_whatsapp }}"
    nombreTitular="{{ $cuenta->nombre_titular }}"
    tipoDocumento="{{ $cuenta->tipo_documento }}"
    numeroDocumento="{{ $cuenta->numero_documento }}"
    numeroCuenta="{{ $cuenta->numero_cuenta }}"
    pagoMovil="{{ $cuenta->pago_movil }}"
    celular="{{ $cuenta->celular }}"
    submitText="Actualizar Cuenta"
    cancelRoute="{{ route('cuentas', ['numero_whatsapp' => $cuenta->numero_whatsapp]) }}"
/>

</div>
@endsection