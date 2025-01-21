@extends('layouts.layout')

@section('title', 'Giros')
@section('content')
<!-- Row superior: Título y Tasa -->
<x-header-content />
<div class="container-fluid d-flex flex-column flex-grow-1">
    <!-- Row inferior: Input de número de WhatsApp -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <x-input-search />
        </div>
    </div>

</div>
@endsection