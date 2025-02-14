<form action="{{ route('cuentas') }}" method="GET">
    <legend class="fs-5">Ingrese su número de WhatsApp y luego de clic en el icono de buscar</legend>
    <div class="input-group">
        <input type="text" name="numero_whatsapp" class="form-control" placeholder="3XX XXX XX XX" required>
        <button type="submit" class="btn btn-transparent">
            <i class="fa fa-search"></i>
        </button>
    </div>
</form>