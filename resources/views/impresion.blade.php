@extends('layouts.layout')

@section('title', 'Impresion')

@section('content')
<div class="container-fluid" x-data="impresionData()">
    <!-- Primer Row -->
    <div class="row mb-3">
        <!-- Formulario Cliente -->
        <div class="col-md-3 mb-2">
            <div class="card p-2 text-color">
                <h5>Ingresa su número de WhatsApp y dirección de envío</h5>
                <div class="mb-2">
                    <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="Carrito" width="20">
                    <label class="form-label"><strong>Número de WhatsApp</strong></label>
                    <input type="text" class="form-control" placeholder="Ingrese su número" x-model="whatsapp">
                </div>
                <div class="mb-2">
                    <img src="{{ asset('images/icons/direccion.svg') }}" alt="Carrito" width="20">
                    <label class="form-label"><strong>Dirección de Envío</strong></label>
                    <input type="text" class="form-control" placeholder="Ingrese su dirección" x-model="direccion">
                </div>
            </div>
        </div>

        <!-- Imagen de Precios -->
        <div class="col-md-6 text-center mb-2">
            <img src="/images/impresiones/precios.svg" class="img-fluid" alt="Tabla de precios">
        </div>

        <!-- Resumen del Pedido -->
        <div class="col-md-3">
            <div class="card p-2 text-color">
                <h5>Resumen del Pedido</h5>
                <p class="mb-2"><strong>Cantidad de Impresiones:</strong> <span x-text="cantidad"></span></p>
                <p class="mb-2"><strong>Envío nacional:</strong> $<span x-text="envio"></span></p>
                <p class="mb-2"><strong>Costo Total:</strong> $<span x-text="total"></span></p>
                <button class="btn btn-transparent" @click="addToCart('impresion', {
    id: Date.now(), // ID único basado en timestamp
    impresion_papel: papel,
    impresion_color: color,
    impresion_caras: caras,
    impresion_cantidad: cantidad || 1, 
    impresion_indicaciones: indicaciones,
    impresion_archivos: archivos,
    precio: total,
    impresion_whatsapp: whatsapp,
    impresion_direccion: direccion,
    cantidad: 1
    })">
                    <img src="{{ asset('images/icons/shopping.svg') }}" alt="Carrito" width="20"> Agregar al carrito
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
                                        <img x-show="vista" :src="vista" class="img-fluid mt-2 rounded" alt="Vista previa">
                                        <p x-show="!vista" x-text="archivos[i].name"></p>
                                    </div>
                                </template>
                            </div>
                            <button @click="indice = (indice - 1 + vistasPrevias.length) % vistasPrevias.length" class="btn btn-transparent">&lt;</button>

                            <button @click="indice = (indice + 1) % vistasPrevias.length" class="btn btn-transparent">&gt;</button>
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
                        <select class="form-select text-color" x-model="papel" @change="calcularTotal">
                            <option value="bond">Papel Bond</option>
                            <option value="opalina">Opalina</option>
                            <option value="fotografico">Fotográfico</option>
                            <option value="adhesivo">Adhesivo</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Color</label>
                        <select class="form-select text-color" x-model="color" @change="calcularTotal">
                            <option value="bn">Blanco y Negro</option>
                            <option value="color">A Color</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Impresión</label>
                        <select class="form-select text-color" x-model="caras" @change="calcularTotal">
                            <option value="1">Una Cara</option>
                            <option value="2">Ambas Caras</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Número de Copias</label>
                        <input type="number" class="form-control text-color" placeholder="Cantidad" x-model="cantidad" @input="calcularTotal">
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
                <div class="mb-3">
                    <label class="form-label">Indicaciones</label>
                    <textarea class="form-control text-color" rows="2" placeholder="Escriba sus indicaciones..." x-model="indicaciones"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection