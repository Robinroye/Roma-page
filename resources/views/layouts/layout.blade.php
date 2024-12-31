<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Roma Servicios')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>

<body class="d-flex flex-column vh-100">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <!-- Footer -->
    <footer class="py-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left Column -->
                <div class="col-md-4 text-start">
                    <a href="#" class="text-decoration-none me-2">Condiciones de uso</a> |
                    <a href="#" class="text-decoration-none ms-2">Aviso de Privacidad</a>
                    <p class="mt-2 mb-0">&copy; 2024 Roma Servicios</p>
                </div>
                <!-- Center Column -->
                <div class="col-md-4 text-start">
                    <p class="mb-0">Calle 23 #55b-25 San Antonio de Pereira <br>Rionegro Antioquia</p>
                </div>
                <!-- Right Column -->
                <div class="col-md-4 text-end">
                    <a href="#" class="text-decoration-none me-3">
                        <img src="{{ asset('images/icons/tiktok.svg') }}" alt="Tiktok.svg">
                    </a>
                    <a href="#" class="text-decoration-none me-3">
                        <img src="{{ asset('images/icons/instagram.svg') }}" alt="instagram.svg">
                    </a>
                    <a href="#" class="text-decoration-none">
                        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp.svg">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>