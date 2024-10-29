<!-- resources/views/diagnosticos/create.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1>Crear Nuevo Diagnóstico</h1>
        <form method="POST" action="{{ route('diagnosticos.api.enviar') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ci">CI:</label>
                <input type="number" class="form-control" id="ci" name="ci" placeholder="Número de CI" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" required>
            </div>
   
            <button type="submit" class="btn btn-primary">Solicitar Diagnóstico API</button>
        </form>
    </div>
@endsection
