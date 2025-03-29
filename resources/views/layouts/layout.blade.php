<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
    <title>@yield('title', 'Roma Servicios')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/styles.css'])
    @stack('styles')
</head>

<body class="d-flex flex-column vh-100" x-data="carritoGlobal">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    @vite(['resources/js/app.js'])
    <main class="flex-grow-1">
        @yield('content')
    </main>

    
    @include('partials.footer')
    <!-- Scripts -->
    @stack('scripts')
</body>

</html>