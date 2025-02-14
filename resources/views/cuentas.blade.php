@extends('layouts.layout')

@section('content')
<!-- Row superior: Título y Tasa -->
<x-header-content />
<div class="container-fluid d-flex flex-column flex-grow-1 mb-2">
    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Row central: Formulario para buscar cuentas -->
    <div class="row">
        <div class="col-md-6">
            <x-input-search />
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4" x-data="cuentasData({{ $cuentas->toJson() }})">
                <div class="mb-3">
                    <!-- Mensaje del número asociado -->
                    @if(isset($numeroWhatsapp))
                    <div class="alert text-color">
                        <h3>Cuentas asociadas al número: {{ $numeroWhatsapp }}</h3>
                    </div>
                    @endif
                    <!-- Botones Agregar y Editar -->
                    <div class="d-flex justify-content-between mb-2">
                        <!-- Botón Agregar -->
                        <a href="{{ route('agregar-cuenta', ['numero_whatsapp' => $numeroWhatsapp]) }}" class="btn btn-transparent">
                            <i class="fa fa-plus"></i> Agregar Cuenta
                        </a>

                        <!-- Botón Editar -->
                        <button type="button" class="btn btn-transparent" x-show="selectedCuenta"
                            x-on:click="window.location.href='{{ route('editar-cuenta', ['id' => ':id']) }}'.replace(':id', selectedCuenta.id)">
                            <i class="fa fa-edit"></i> Editar Cuenta
                        </button>

                    </div>
                    <label for="cuentas" class="form-label text-color">Seleccione una cuenta para realizar la transferencia:</label>
                    <select id="cuentas" name="cuentas" class="form-select text-color" x-model="selectedCuentaId" x-on:change="actualizarDetalles">
                        <template x-for="cuenta in cuentas" :key="cuenta.id">
                            <option :value="cuenta.id" x-text="`${cuenta.nombre_titular} / ${cuenta.numero_cuenta}`"></option>
                        </template>
                    </select>
                </div>

                <!-- Detalles de la cuenta seleccionada -->
                <div class="text-color" x-show="selectedCuenta">
                    <p><strong>Nombre Titular:</strong> <span x-text="selectedCuenta.nombre_titular"></span></p>
                    <p><strong>Tipo de Documento:</strong> <span x-text="selectedCuenta.tipo_documento"></span></p>
                    <p><strong>Número de Documento:</strong> <span x-text="selectedCuenta.numero_documento"></span></p>
                    <p><strong>Número de Cuenta:</strong> <span x-text="selectedCuenta.numero_cuenta"></span></p>
                    <p><strong>Pago Móvil:</strong> <span x-text="selectedCuenta.pago_movil"></span></p>
                </div>

                <!-- Campo para ingresar monto y usar calculadora -->
                <div class="mt-2 text-color" x-data="calculadora()">
                    <label for="monto" class="form-label">Monto a enviar:</label>
                    <div class="d-flex flex-column">
                        <label for="dolares">USD/ Dólar Americano</label>
                        <input id="dolares" type="number" class="form-control calculadora mb-2" x-model.number="dolares" x-on:input="convertir('dolares')">

                        <label for="bss">Bss/ Bolívares</label>
                        <input id="bss" type="number" class="form-control calculadora mb-2" x-model.number="bss" x-on:input="convertir('bss')">

                        <label for="cop">COP/ Peso Colombiano</label>
                        <input id="cop" type="number" class="form-control calculadora" x-model.number="cop" x-on:input="convertir('cop')">
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button class="btn btn-transparent" @click="addToCart('giro', {
    id: Date.now(), // ID único
    nombre_titular: selectedCuenta.nombre_titular,
    tipo_documento: selectedCuenta.tipo_documento,
    numero_documento: selectedCuenta.numero_documento,
    numero_cuenta: selectedCuenta.numero_cuenta,
    pago_movil: selectedCuenta.pago_movil,
    monto_bss: bss.value || 0,
    monto_dolares: dolares.value || 0,
    monto_cop: cop.value || 0,
    precio: cop.value || 0,
    cantidad: 1
})">
                        <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito" width="20"> Agregar al carrito
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function cuentasData(cuentas) {
        return {
            cuentas: cuentas,
            selectedCuentaId: cuentas.length > 0 ? cuentas[0].id : null,
            selectedCuenta: cuentas.length > 0 ? cuentas[0] : null,

            actualizarDetalles() {
                this.selectedCuenta = this.cuentas.find(cuenta => cuenta.id == this.selectedCuentaId);
            }
        };
    }
</script>
@endsection