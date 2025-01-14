@extends('layouts.layout')

@section('content')
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

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Row central: Formulario para buscar cuentas -->
    <div class="row justify-content-center mb-4">
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

    <!-- Listado de cuentas -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="mb-3">
                    <label for="cuentas" class="form-label">Seleccione una cuenta para realizar la transferencia:</label>
                    <select id="cuentas" name="cuentas" class="form-select">
                        <!-- Generar opciones dinámicamente desde la base de datos -->
                        @forelse($cuentas as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->nombre_titular }} / {{ $cuenta->numero_cuenta }}</option>
                        @empty
                            <option>No hay cuentas registradas</option>
                        @endforelse
                    </select>
                </div>

                <!-- Detalles de la cuenta seleccionada -->
                @if(!$cuentas->isEmpty())
                <div class="mb-3">
                    <p><strong>Nombre Titular:</strong> {{ $cuentas->first()->nombre_titular }}</p>
                    <p><strong>Tipo de Documento:</strong> {{ $cuentas->first()->tipo_documento }}</p>
                    <p><strong>Número de Documento:</strong> {{ $cuentas->first()->numero_documento }}</p>
                    <p><strong>Número de Cuenta:</strong> {{ $cuentas->first()->numero_cuenta }}</p>
                    <p><strong>Pago Móvil:</strong> {{ $cuentas->first()->pago_movil }}</p>
                </div>
                @endif
                <div class="text-end">
                    <button type="button" class="btn btn-success">Realizar Transferencia</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection