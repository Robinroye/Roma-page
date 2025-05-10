<header class="navbar navbar-expand-lg border-bottom mb-3">
    <div class="container-fluid">
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
                <form class="d-flex position-relative" x-data="buscador()" @submit.prevent="buscar()">
                    <!-- Input de búsqueda -->
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar" x-model="query" @input="filtrarSugerencias()" @keydown.down="seleccionarSiguiente()" @keydown.up="seleccionarAnterior()" @keydown.enter.prevent="confirmarSeleccion()" @focus="mostrarSugerencias = true" @blur="ocultarConRetraso()">

                    <!-- Botón de búsqueda -->
                    <button class="btn search" type="submit">Buscar</button>

                    <!-- Lista de sugerencias -->
                    <ul class="list-group position-absolute w-50 mt-2" style="z-index: 1000;" x-show="mostrarSugerencias && sugerencias.length > 0">
                        <template x-for="(sugerencia, index) in sugerencias" :key="index">
                            <li class="list-group-item list-group-item" :class="{ 'active': index === indiceSeleccionado }" @click="seleccionarSugerencia(index)" @mouseover="indiceSeleccionado = index">
                                <span x-text="sugerencia"></span>
                            </li>
                        </template>
                    </ul>

                    <script>
                        function buscador() {
                            return {
                                query: '',
                                keywordMap: {
                                    'impresion': '/impresion',
                                    'fotocopias': '/impresion',
                                    'copias': '/impresion',
                                    'variedades': '/variedades',
                                    'aretes': '/variedades#aretes',
                                    'bisuteria': '/variedades#bisuteria',
                                    'plotter': '/plotter',
                                    'stickers': '/plotter#stickers',
                                    'bss': '/giros',
                                    'giros': '/giros',
                                    'calculadora': '/home#calculadora'
                                },
                                sugerencias: [],
                                mostrarSugerencias: false,
                                indiceSeleccionado: -1,

                                filtrarSugerencias() {
                                    if (this.query.length === 0) {
                                        this.sugerencias = [];
                                        return;
                                    }

                                    let term = this.query.toLowerCase();
                                    this.sugerencias = Object.keys(this.keywordMap).filter(keyword => keyword.includes(term));

                                    this.indiceSeleccionado = -1;
                                },

                                buscar() {
                                    if (this.sugerencias.length > 0 && this.indiceSeleccionado >= 0) {
                                        this.query = this.sugerencias[this.indiceSeleccionado];
                                    }

                                    let url = this.keywordMap[this.query.toLowerCase()];
                                    if (url) {
                                        window.location.href = url;
                                    } else {
                                        alert('No se encontró ninguna coincidencia.');
                                    }
                                },

                                seleccionarSugerencia(index) {
                                    this.query = this.sugerencias[index];
                                    this.buscar();
                                },

                                seleccionarSiguiente() {
                                    if (this.sugerencias.length > 0) {
                                        this.indiceSeleccionado = (this.indiceSeleccionado + 1) % this.sugerencias.length;
                                    }
                                },

                                seleccionarAnterior() {
                                    if (this.sugerencias.length > 0) {
                                        this.indiceSeleccionado = (this.indiceSeleccionado - 1 + this.sugerencias.length) % this.sugerencias.length;
                                    }
                                },

                                confirmarSeleccion() {
                                    if (this.indiceSeleccionado >= 0) {
                                        this.query = this.sugerencias[this.indiceSeleccionado];
                                        this.buscar();
                                    }
                                },

                                ocultarConRetraso() {
                                    setTimeout(() => {
                                        this.mostrarSugerencias = false;
                                    }, 200);
                                }
                            };
                        }
                    </script>
                </form>
                <li class="nav-item list-unstyled">
                    <a class="nav-link" href="{{ route('ayuda') }}">
                        <img src="{{ asset('images/icons/help.svg') }}" alt="Ayuda">
                    </a>
                </li>
                <li class="nav-item carrito list-unstyled">
                    <a class="nav-link" href="{{ route('carrito') }}">
                        <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito">
                    </a>
                    <b class="items" x-show="itemCount" x-effect="itemCount = itemCount" x-text="itemCount"></b>
                </li>
            </div>
        </div>
    </div>
</header>