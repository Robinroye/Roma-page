@extends('layouts.layout')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid mt-4" x-data="admin">
        <h2 class="text-center">Panel de Administración</h2>

        <!-- Tabs de navegación -->
        <ul class="nav nav-tabs justify-content-center" id="adminTabs" role="tablist">
            <li class="nav-item text-color">
                <a class="nav-link text-color active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab">Home /
                    Calculadora</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-color" id="giros-tab" data-bs-toggle="tab" href="#giros" role="tab">Giros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-color" id="productos-tab" data-bs-toggle="tab" href="#productos"
                    role="tab">Variedades / Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-color" id="impresion-tab" data-bs-toggle="tab" href="#impresion"
                    role="tab">Impresión</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-color" id="pedidos-tab" data-bs-toggle="tab" href="#pedidos"
                    role="tab">Pedidos</a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content mt-3" id="adminTabContent">
            <!-- Sección Home / Calculadora -->
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <div class="container my-4">
                    <h4>Configuración de Tasa de Cambio</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('exchange-rate.update') }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="tasa" class="form-label">Tasa actual</label>
                            <input type="number" step="0.01" class="form-control" id="tasa" name="tasa"
                                value="{{ $tasa->tasa }}" required>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-transparent">Actualizar Tasa</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sección Giros -->
            <div class="tab-pane fade" id="giros" role="tabpanel">
                <h4>Administración de Giros</h4>
                <p>Aquí se gestionarán los giros.</p>
            </div>

            <!-- Sección Variedades / Productos -->
            <div class="tab-pane fade" id="productos" role="tabpanel">
                <h4 class="text-center mb-4">Administración de Productos</h4>
                <div class="container">
                    <div class="row">
                        <!-- Formulario de Agregar Producto -->
                        <div class="col-md-5">
                            <div class="card p-4 shadow">
                                <h5 class="text-center">Agregar Producto</h5>
                                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data"
                                    x-data="{ preview: [] }">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Nombre del Producto</label>
                                        <input type="text" name="nombre" class="form-control"
                                            placeholder="Ej: Anillo de Plata" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Precio</label>
                                        <input type="number" name="precio" class="form-control" placeholder="Ej: 50000"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea name="descripcion" class="form-control" placeholder="Breve descripción del producto" rows="2"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Stock Disponible</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Ej: 10"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Selecciona una imagen:</label>
                                        <input type="file" name="imagenes[]" id="imagenes" class="form-control" multiple
                                            accept="image/*"
                                            x-on:change="preview = [...$event.target.files].map(file => URL.createObjectURL(file))">
                                    </div>

                                    <!-- Vista previa de imágenes -->
                                    <div class="mb-3" x-show="preview.length > 0">
                                        <h6>Vista previa:</h6>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <template x-for="img in preview" :key="img">
                                                <img :src="img" class="img-thumbnail" width="80">
                                            </template>
                                        </div>
                                    </div>

                                    <button class="btn btn-transparent w-100" type="submit">Guardar Producto</button>
                                </form>
                            </div>
                        </div>

                        <!-- Listado de productos -->
                        <div class="col-md-7">
                            <div class="card p-4 shadow">
                                <h5 class="text-center">Lista de Productos</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . json_decode($producto->imagenes)[0]) }}"
                                                            class="img-thumbnail" width="50">
                                                    </td>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                                                    <td>{{ $producto->stock }}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editarProductoModal"
                                                            data-id="{{ $producto->id }}"
                                                            data-nombre="{{ $producto->nombre }}"
                                                            data-precio="{{ $producto->precio }}"
                                                            data-descripcion="{{ $producto->descripcion }}"
                                                            data-stock="{{ $producto->stock }}">
                                                            Editar
                                                        </button>

                                                        <form action="{{ route('productos.destroy', $producto->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($productos->isEmpty())
                                    <p class="text-center mt-3">No hay productos registrados.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección Impresión -->
            <div class="tab-pane fade" id="impresion" role="tabpanel">
                <h4 class="text-center mb-4">Administración de Impresiones</h4>
                <div class="container">
                    <div class="row">
                        <!-- Formulario de Agregar Producto -->
                        <div class="col-md-5">
                            <div class="card p-4 shadow">
                                <h5 class="text-center">Agregar tipo de impresion</h5>
                                <form action="{{ route('admin.storeTipoImpresion') }}" method="POST"
                                    enctype="multipart/form-data" x-data="{ preview: [] }">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Nombre del papel</label>
                                        <input type="text" name="tipo_papel" class="form-control"
                                            placeholder="Ej: Opalina" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label d-block">Color</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color" id="color_bn"
                                                value="bn" required>
                                            <label class="form-check-label" for="color_bn">B/N</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                id="color_color" value="color">
                                            <label class="form-check-label" for="color_color">Color</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Precio por pagina</label>
                                        <input type="number" name="precio" class="form-control" placeholder="Ej: 2800"
                                            required>
                                    </div>

                                    <button class="btn btn-transparent w-100" type="submit">Guardar Tipo de
                                        Impresion</button>
                                </form>
                            </div>
                        </div>

                        <!-- Listado de tipos de Impresion -->
                        <div class="col-md-7">
                            <div class="card p-4 shadow">
                                <h5 class="text-center">Lista de Tipos de Impresion</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Tipo de papel</th>
                                                <th>Color</th>
                                                <th>Precio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tiposDeImpresion as $tipoDeImpresion)
                                                <tr>
                                                    <td>{{ $tipoDeImpresion->tipo_papel }}</td>
                                                    <td>{{ $tipoDeImpresion->color }}</td>
                                                    <td>${{ number_format($tipoDeImpresion->precio, 0, ',', '.') }}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editTipoImpresionModal"
                                                            onclick="populateEditModal({{ $tipoDeImpresion }})">Editar</button>
                                                        <form
                                                            action="{{ route('admin.deleteTipoImpresion', ['id' => $tipoDeImpresion->id]) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($tiposDeImpresion->isEmpty())
                                    <p class="text-center mt-3">No hay Tipos de Impresion registrados.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pedidos" role="tabpanel">
                <h4 class="text-center mb-4">Administración de Pedidos</h4>
                <div class="container">
                        
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center mb-3">
                            <label class="me-3">
                                <input type="checkbox" x-model="showPending" class="me-1" autocomplete="off"> Pendientes
                            </label>
                            <label>
                                <input type="checkbox" x-model="showCompleted" class="me-1" autocomplete="off"> Completados
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion" id="pedidosAccordion">
                                <template x-for="pedido in orders" :key="pedido.id">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" :id="`heading${pedido.id}`">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="`#collapse${pedido.id}`" aria-expanded="false" :aria-controls="`collapse${pedido.id}`" x-text="`Pedido #${pedido.id} | ${pedido.user_phone}`">
                                                
                                            </button>
                                        </h2>
                                        <div :id="`collapse${pedido.id}`" class="accordion-collapse collapse" :aria-labelledby="`heading${pedido.id}`" data-bs-parent="#pedidosAccordion">
                                            <div class="accordion-body">
                                                <div class="btn-group mt-3" role="group" aria-label="Acciones">
                                                    <button type="button" class="btn btn-primary" :class="!allDetailsCompleted(pedido.id)? 'disabled': ''" @click="pedido.estado== 'pendiente'?completeOrder(pedido.id):dontCompleteOrder(pedido.id)" x-text="pedido.estado== 'despachado'? 'Pendiente': 'Completado'">Completado</button>
                                                    <button type="button" class="btn btn-danger" @click="destroyOrder(pedido.id)">Eliminar pedido y archivos</button>
                                                </div>
                                                    <template x-for="(detalle, indexDetalle) in pedido.detalles" :key="indexDetalle">
                                                        <div class="pedido">
                                                            <template x-if="detalle.tipo == 'impresion'">
                                                                <div class="pedido-detalle" :class="completionOrders[pedido.id][detalle.id]? 'completed': ''">
                                                                    <hr x-show="!!indexDetalle">  
                                                                    <label>
                                                                        <strong>Tipo de item:</strong>
                                                                        <span>Impresión</span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Precio unitario:</strong>
                                                                        <span x-text="detalle.precio"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Cantidad:</strong>
                                                                        <span x-text="detalle.cantidad"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Caras:</strong>
                                                                        <span x-text="detalle.impresion_caras"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Color:</strong>
                                                                        <span x-text="detalle.impresion_color"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Papel:</strong>
                                                                        <span x-text="detalle.impresion_papel"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Páginas por impresión:</strong>
                                                                        <span x-text="detalle.impresion_paginas"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Páginas totales:</strong>
                                                                        <span x-text="detalle.impresion_paginas * detalle.cantidad"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Archivo adjunto:</strong>
                                                                        <a :href="`/storage/uploads/${detalle.impresion_archivos?.split('/').pop()}`" target="_blank" download>
                                                                            Descargar
                                                                        </a>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Indicaciones:</strong>
                                                                        <span x-text="detalle.impresion_indicaciones"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Completado:</strong>
                                                                        <input type="checkbox" x-model="completionOrders[pedido.id][detalle.id]" autocomplete="off" @change="saveCompletion(pedido.id, detalle.id, $event.target.checked)" :checked="detalle.completado" class="form-check-input">   
                                                                    </label>
                                                                </div>
                                                            </template>
                                                            <template x-if="detalle.tipo == 'variedad'">
                                                                <div class="pedido-detalle" :class="completionOrders[pedido.id][detalle.id]? 'completed': ''">
                                                                    <hr x-show="!!indexDetalle">  
                                                                    <label>
                                                                        <strong>Tipo de item:</strong>
                                                                        <span>Variedad</span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Código del producto:</strong>
                                                                        <span x-text="detalle.productoId"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Nombre:</strong>
                                                                        <span x-text="detalle.nombre"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Precio:</strong>
                                                                        <span x-text="detalle.precio"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Cantidad:</strong>
                                                                        <span x-text="detalle.cantidad"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Completado:</strong>
                                                                        <input type="checkbox" x-model="completionOrders[pedido.id][detalle.id]" autocomplete="off" @change="saveCompletion(pedido.id, detalle.id, $event.target.checked)" :checked="detalle.completado" class="form-check-input">   
                                                                    </label>
                                                                </div>
                                                            </template>
                                                            <template x-if="detalle.tipo == 'giro'">
                                                                <div class="pedido-detalle" :class="completionOrders[pedido.id][detalle.id]? 'completed': ''">
                                                                    <hr x-show="!!indexDetalle">  
                                                                    <label>
                                                                        <strong>Tipo de item:</strong>
                                                                        <span>Giro</span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Monto BSS:</strong>
                                                                        <span x-text="detalle.monto_bss"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Monto USD:</strong>
                                                                        <span x-text="detalle.monto_dolares"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Monto COP:</strong>
                                                                        <span x-text="detalle.monto_cop"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Pago Móvil:</strong>
                                                                        <span x-text="detalle.pago_movil"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Número de cuenta:</strong>
                                                                        <span x-text="detalle.numero_cuenta"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Titular:</strong>
                                                                        <span x-text="detalle.nombre_titular"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Documento:</strong>
                                                                        <span x-text="`(${detalle.tipo_documento}) ${detalle.numero_documento}`"></span>
                                                                    </label>
                                                                    <label>
                                                                        <strong>Completado:</strong>
                                                                        <input type="checkbox" x-model="completionOrders[pedido.id][detalle.id]" autocomplete="off" @change="saveCompletion(pedido.id, detalle.id, $event.target.checked)" :checked="detalle.completado" class="form-check-input">   
                                                                    </label>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para editar producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="formEditarProducto" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarProductoLabel">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="producto_id" name="id">
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label>Precio</label>
                            <input type="number" class="form-control" id="editar_precio" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea class="form-control" id="editar_descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Stock</label>
                            <input type="number" class="form-control" id="editar_stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label>Nuevas Imágenes (opcional)</label>
                            <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal for Editing Tipos de Impresion -->
    <div class="modal fade" id="editTipoImpresionModal" tabindex="-1" aria-labelledby="editTipoImpresionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTipoImpresionModalLabel">Editar Tipo de Impresión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTipoImpresionForm" method="POST"
                    action="{{ route('admin.updateTipoImpresion', ['id' => '1']) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editTipoImpresionId">
                        <div class="mb-3">
                            <label class="form-label">Nombre del papel</label>
                            <input type="text" name="tipo_papel" id="editNombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Color</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="color" id="editColorBn"
                                    value="bn" required>
                                <label class="form-check-label" for="editColorBn">B/N</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="color" id="editColorColor"
                                    value="color">
                                <label class="form-check-label" for="editColorColor">Color</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio por página</label>
                            <input type="number" name="precio" id="editPrecio" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const modalEditar = document.getElementById('editarProductoModal');
        modalEditar.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
    
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const precio = button.getAttribute('data-precio');
            const descripcion = button.getAttribute('data-descripcion');
            const stock = button.getAttribute('data-stock');
    
            // Asignar los datos al formulario
            document.getElementById('producto_id').value = id;
            document.getElementById('editar_nombre').value = nombre;
            document.getElementById('editar_precio').value = precio;
            document.getElementById('editar_descripcion').value = descripcion;
            document.getElementById('editar_stock').value = stock;
    
            // Cambiar la acción del formulario
            const form = document.getElementById('formEditarProducto');
            form.action = `/productos/${id}`;
        });
    </script>
    <script>
        function populateEditModal(tipoDeImpresion) {
            // Set form action dynamically
            const form = document.getElementById('editTipoImpresionForm');
            form.action = `{{ url('admin/updateTipoImpresion') }}/${tipoDeImpresion.id}`;

            // Populate modal fields
            document.getElementById('editTipoImpresionId').value = tipoDeImpresion.id;
            document.getElementById('editNombre').value = tipoDeImpresion.tipo_papel;
            document.getElementById('editPrecio').value = tipoDeImpresion.precio;
            if (tipoDeImpresion.color === 'bn') {
                document.getElementById('editColorBn').checked = true;
            } else {
                document.getElementById('editColorColor').checked = true;
            }
        }
    </script>
@endsection
