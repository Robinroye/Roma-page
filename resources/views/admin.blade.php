@extends('layouts.layout')

@section('title', 'Admin')

@section('content')
<div class="container-fluid">
    <h2>Administración de Productos</h2>
    <div class="col-12">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">
                <input type="text" name="nombre" placeholder="Nombre del producto" required>
                <input type="number" name="precio" placeholder="Precio" required>
                <textarea name="descripcion" placeholder="Descripción"></textarea>
                <input type="number" name="stock" placeholder="Unidades disponibles" required>
        
                <label for="imagenes">Selecciona una imagen:</label>
                <input type="file" name="imagenes[]" id="imagenes" multiple accept="image/*">
            </div>
            <button class="btn-transparent mt-2" type="submit">Guardar</button>
        </form>
    </div>

</div>
@endsection