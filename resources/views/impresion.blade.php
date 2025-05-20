@extends('layouts.layout')

@section('title', 'Impresion')

@section('content')
    <div class="container-fluid" x-data="impresionData()">
        <!-- Primer Row -->
        <div class="row mb-3">
            <!-- Formulario Cliente -->
            

            <!-- Imagen de Precios -->
            <div class="col-md-9 text-center mb-2">
                <img src="/images/impresiones/precios.svg" class="img-fluid" alt="Tabla de precios">
            </div>

            <!-- Resumen del Pedido -->
            <div class="col-md-3">
                <div class="card p-2 text-color">
                    <h5>Resumen del Pedido</h5>
                    <p class="mb-2"><strong>Cantidad de Impresiones:</strong> <span x-text="cantidad"></span></p>
                    <p class="mb-2"><strong>Costo sin Copias:</strong> $<span x-text="total"></span></p>
                    <p class="mb-2"><strong>Costo con Copias:</strong> $<span x-text="totalConCopias"></span></p>
                    <button class="btn btn-transparent" @click="addToCart('impresion', settings, archivos)">
                        <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito" width="20"> Agregar al
                        carrito
                    </button>

                    </button>
                    <p class="text-success mt-2">Envío gratis a partir de $120.000</p>
                </div>
            </div>
        </div>

        <!-- Segundo Row -->
        <div class="row">
            <!-- Cargar Archivo -->
            <div class="col-md-4 mb-2">
                <div class="card p-3 text-center text-color">

                    <!-- Botón para cargar archivos -->
                    <label for="archivo" class="btn btn-transparent">
                        <img src="{{ asset('images/icons/adjuntar.svg') }}" alt="Adjuntar" width="50">
                        <i class="bi bi-upload"></i> Cargar Archivo
                    </label>

                    <input type="file" id="archivo" class="d-none" multiple @change="cargarArchivos">

                    <p class="mt-2">Formatos permitidos: PDF, JPG, PNG, DOCX, XLSX</p>

                    <!-- Contenedor de previsualización -->
                    <div id="preview" class="mt-2">

                        <!-- Carrusel de imágenes si hay archivos cargados -->
                        <template x-if="vistasPrevias.length > 0">
                            <div class="carousel">
                                <div class="preview-container mb-2">
                                    <template x-for="(vista, i) in vistasPrevias" :key="i">
                                        <div x-show="i === indice">
                                            <!-- IMAGE PREVIEW -->
                                            <img x-show="vista.type === 'img'" :src="vista.src"
                                                class="img-fluid mt-2 rounded" alt="Vista previa">

                                            <!-- PDF PREVIEW -->
                                            <iframe x-show="vista.type === 'pdf'" :src="vista.src"
                                                class="pdf-preview mt-2 rounded" width="100%" height="300px"></iframe>

                                            <!-- DOCX PREVIEW (Rendered HTML) -->
                                            <div x-show="vista.type === 'docx'" class="docx-preview mt-2"
                                                x-html="vista.html"></div>

                                            <!-- OTHER FILES -->
                                            <p x-show="vista.type === 'other'" x-text="vista.name"></p>

                                            <!-- PAGE COUNT -->
                                            <p x-show="vista.type !== 'image' && paginas[i] !== undefined">
                                                Páginas: <strong x-text="paginas[i]"></strong>
                                            </p>
                                        </div>
                                    </template>
                                </div>
                                <button @click="prevFile()" class="btn btn-transparent">&lt;</button>
                                <button @click="nextFile()" class="btn btn-transparent">&gt;</button>
                            </div>
                        </template>

                        <!-- Contador de archivos cargados -->
                        <p class="mt-2" x-show="archivos.length > 0">
                            <strong x-text="archivos.length"></strong> archivo(s) cargado(s).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Opciones de Impresión -->
            <div class="col-md-8">
                <div class="card p-3 text-color mb-2">
                    <h5>Opciones de Impresión</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Papel</label>
                            <select class="form-select text-color" x-model="settings[indice].papel" @change="calcularTotal">
                                @foreach ($tiposPapel as $tipoPapel)
                                    <option @if ($tipoPapel == 'bond') selected @endif value="{{ $tipoPapel }}">
                                        {{ $tipoPapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Color</label>
                            <template x-if="!settings[indice] || impresionBNPermitido.includes(settings[indice].papel)">
                                <select class="form-select text-color" x-model="settings[indice].color"
                                    @change="calcularTotal">
                                    <option selected value="bn">Blanco y Negro</option>
                                    <option value="color">A Color</option>
                                </select>
                            </template>
                            <template x-if="!impresionBNPermitido.includes(settings[indice].papel)">
                                <select class="form-select text-color" x-model="settings[indice].color"
                                    @change="calcularTotal">
                                    <option selected value="color">A Color</option>
                                </select>
                            </template>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Impresión</label>
                            <select class="form-select text-color" x-model="settings[indice].caras"
                                @change="calcularTotal">
                                <option value="1">Una Cara</option>
                                <option value="2">Ambas Caras</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número de Copias</label>
                            <input type="number" class="form-control text-color" placeholder="Cantidad"
                                x-model="settings[indice].cantidad" @input="calcularTotal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tamaño de papel</label>
                            <select class="form-select text-color">
                                <option>Carta/A4</option>
                                <option>Oficio</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posicion en la hoja</label>
                            <select class="form-select text-color">
                                <option>Una imagen por hoja</option>
                                <option>Dos imagenes en una hoja</option>
                                <option>Cuatro imagenes en una hoja</option>
                                <option>Seis imagenes en una hoja</option>
                                <option>Nueve imagenes en una hoja</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cantidad de paginas</label>
                            <br>
                            <input type="text" x-model="settings[indice].paginas" @input="calcularTotal">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paginas a imprimir (<span
                                    x-text="settings[indice].paginasTotales"></span>)</label>
                            <br>
                            <input type="text" x-model="settings[indice].paginasAImprimir" @input="calcularTotal">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Indicaciones</label>
                        <textarea class="form-control text-color" rows="2" placeholder="Escriba sus indicaciones..."
                            x-model="settings[indice].indicaciones"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
