@props([
    'action', // La ruta del formulario
    'method' => 'POST', // El método del formulario (por defecto POST)
    'numeroWhatsapp' => null, // El número de WhatsApp (puede ser null)
    'nombreTitular' => null, // Nombre del titular (puede ser null para edición)
    'tipoDocumento' => null, // Tipo de documento preseleccionado
    'numeroDocumento' => null, // Número de documento
    'numeroCuenta' => null, // Número de cuenta
    'pagoMovil' => null, // Pago móvil
    'submitText' => 'Guardar', // Texto del botón de envío
    'cancelRoute' => null, // Ruta de cancelación (opcional)
])

<form action="{{ $action }}" method="{{ strtolower($method) === 'get' ? 'GET' : 'POST' }}">
    @csrf
    @if(strtolower($method) !== 'get' && strtolower($method) !== 'post')
        @method($method)
    @endif

    <!-- Campo oculto para el número de WhatsApp -->
    @if($numeroWhatsapp)
        <input type="hidden" name="numero_whatsapp" value="{{ $numeroWhatsapp }}">
    @endif

<!-- Número de WhatsApp -->
<div class="mb-3">
    <label for="numero_whatsapp" class="form-label">Número de WhatsApp</label>
    <input 
        type="text" 
        name="numero_whatsapp" 
        id="numero_whatsapp" 
        class="form-control" 
        value="{{ $numeroWhatsapp ?? old('numero_whatsapp') }}" 
        required
    >
</div>

    <!-- Nombre del titular -->
    <div class="mb-3 text-color">
        <label for="nombre_titular" class="form-label">Nombre del titular</label>
        <input type="text" id="nombre_titular" name="nombre_titular" class="form-control" value="{{ $nombreTitular }}" required>
    </div>

    <!-- Tipo de documento -->
    <div class="mb-3 text-color">
        <label for="tipo_documento" class="form-label">Tipo de documento</label>
        <select id="tipo_documento" name="tipo_documento" class="form-control" required>
            <option value="">Seleccione</option>
            <option value="V" {{ $tipoDocumento === 'V' ? 'selected' : '' }}>V</option>
            <option value="Ext" {{ $tipoDocumento === 'Ext' ? 'selected' : '' }}>Ext</option>
            <option value="J" {{ $tipoDocumento === 'J' ? 'selected' : '' }}>J</option>
        </select>
    </div>

    <!-- Número de documento -->
    <div class="mb-3 text-color">
        <label for="numero_documento" class="form-label">Número de documento</label>
        <input type="number" id="numero_documento" name="numero_documento" class="form-control" value="{{ $numeroDocumento }}" required>
    </div>

    <!-- Número de cuenta -->
    <div class="mb-3 text-color">
        <label for="numero_cuenta" class="form-label">Número de cuenta</label>
        <input type="number" id="numero_cuenta" name="numero_cuenta" class="form-control" value="{{ $numeroCuenta }}" required>
    </div>

    <!-- Pago móvil -->
    <div class="mb-3 text-color">
        <label for="pago_movil" class="form-label">Pago móvil</label>
        <input type="text" id="pago_movil" name="pago_movil" class="form-control" value="{{ $pagoMovil }}" required>
    </div>

    <!-- Botones -->
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">{{ $submitText }}</button>
        @if($cancelRoute)
            <a href="{{ $cancelRoute }}" class="btn btn-secondary">Cancelar</a>
        @endif
    </div>
</form>
