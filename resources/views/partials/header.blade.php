<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roma Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header class="navbar navbar-expand-lg border-bottom">
        <div class="container-fluid
        ">
            <!-- Logo -->
            <a class="navbar-brand pt-0 logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logos/logo.svg') }}" alt="Logo Roma Servicios">
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active text-warning' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('giros') ? 'active text-warning' : '' }}" href="{{ route('giros') }}">Giros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('variedades') ? 'active text-warning' : '' }}" href="{{ route('variedades') }}">Variedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('impresion') ? 'active text-warning' : '' }}" href="{{ route('impresion') }}">Impresión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('plotter') ? 'active text-warning' : '' }}" href="{{ route('plotter') }}">Plotter</a>
                    </li>
                </ul>

                <!-- Right Section: Search, Help, Cart -->
                <div class="d-flex align-items-center gap-3">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                        <button class="btn search" type="submit">Buscar</button>
                    </form>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link" href="{{ route('ayuda') }}">
                            <img src="{{ asset('images/icons/help.svg') }}" alt="Ayuda">
                        </a>
                    </li>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link" href="{{ route('carrito') }}">
                            <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito">
                        </a>
                    </li>

                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>