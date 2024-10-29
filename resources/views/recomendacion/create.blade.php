@extends('layouts.app')

@section('title', 'Crear Recomendación')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-weight: bold;">Crear Recomendación</h1>

    <form action="{{ route('recomendacion.store') }}" method="POST">
        @csrf

        <!-- Campo oculto para diagnostico_id -->
        <input type="hidden" id="diagnostico_id" name="diagnostico_id">

        <div class="form-group">
            <label for="diagnostico_id">Seleccionar Diagnóstico:</label>
            <div class="table-responsive">
                <table class="table table-bordered" id="diagnosticosTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Cliente</th>
                            <th>Resultado IA</th>
                            <th>Resultado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnosticos as $diagnostico)
                        <tr>
                            <td>{{ $diagnostico->id }}</td>
                            <td>{{ $diagnostico->cliente->name }}</td>
                            <td>{{ $diagnostico->resultado_ia }}</td>
                            <td>{{ $diagnostico->resultado }}</td>
                            <td>{{ $diagnostico->created_at }}</td>
                            <td>
                                <button type="button" 
                                        class="btn btn-primary btn-sm select-diagnostico" 
                                        data-id="{{ $diagnostico->id }}"
                                        data-nombre-cliente="{{ $diagnostico->cliente->name }}"
                                        data-resultado-ia="{{ $diagnostico->resultado_ia }}"
                                        data-resultado="{{ $diagnostico->resultado }}"
                                        data-imagenes="{{ $diagnostico->ecografias->pluck('path')->implode(',') }}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre Cliente:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" readonly>
        </div>
        
        <div class="form-group">
            <label for="recomenda">Resultado de la IA:</label>
            <textarea class="form-control" id="recomenda" name="recomenda" readonly></textarea>
        </div>

        <div class="form-group">
            <label for="resultado">Resultado:</label>
            <input type="text" class="form-control" id="resultado" name="resultado" value="">
        </div>

        <div class="form-group">
            <label for="imagenes">Imágenes:</label>
            <div id="imagenes" class="d-flex flex-wrap"></div>
        </div>

        <div class="form-group">
            <label for="recomendacion">Recomendación:</label>
            <textarea class="form-control" id="recomendacion" name="recomendacion" rows="5" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar recomendación</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const diagnosticoIdInput = document.getElementById('diagnostico_id');
        const nombreClienteInput = document.getElementById('nombre');
        const resultadosInput = document.getElementById('recomenda');
        const resultadosDiagnosticoInput = document.getElementById('resultado');
        const imagenesContainer = document.getElementById('imagenes');

        document.querySelectorAll('.select-diagnostico').forEach(button => {
            button.addEventListener('click', function () {
                const diagnosticoId = this.getAttribute('data-id');
                const nombreCliente = this.getAttribute('data-nombre-cliente');
                const resultados = this.getAttribute('data-resultado-ia');
                const resultadoDiag = this.getAttribute('data-resultado');
                const imagenes = this.getAttribute('data-imagenes').split(',');

                // Rellenar campos
                diagnosticoIdInput.value = diagnosticoId;
                nombreClienteInput.value = nombreCliente;
                resultadosInput.value = resultados;
                resultadosDiagnosticoInput.value = resultadoDiag;

                // Limpiar y mostrar imágenes
                imagenesContainer.innerHTML = '';
                imagenes.forEach(function (url) {
                    if (url.trim() !== '') {
                        const img = document.createElement('img');
                        img.src = url.trim();
                        img.alt = 'Ecografía';
                        img.className = 'img-thumbnail m-2';
                        img.style.maxWidth = '250px';
                        img.style.height = 'auto';
                        imagenesContainer.appendChild(img);
                    }
                });
            });
        });
    });
</script>
@endsection
