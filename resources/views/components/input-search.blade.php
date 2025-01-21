<form action="{{ route('cuentas') }}" method="GET">
    <legend class="fs-5">Ingrese su número de WhatsApp y luego de clic en la lupa</legend>
    <div class="input-group">
        <input type="text" name="numero_whatsapp" class="form-control" placeholder="300 667 00 97" required>
        <button type="submit" class="btn btn-transparent">
            <i class="fa fa-search"></i>
        </button>
    </div>
</form>