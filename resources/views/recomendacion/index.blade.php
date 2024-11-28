@extends('layouts.index')

@section('content')
<h1 class="text-center" style="font-weight: bold;" class="mb-4">Recomendaciones del médico</h1>
<div class="container">

    <!-- Filtro de fechas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <label for="start_date" class="form-label">Fecha desde:</label>
            <input type="date" id="start_date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Fecha hasta:</label>
            <input type="date" id="end_date" class="form-control">
        </div>
    </div>

    <h1 class="text-center">Recomendaciones del médico</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tablaRecomendaciones">
            <thead>
                <tr>
                    <th>Nombre del Médico</th>
                    <th>Recomendación</th>
                    <th>Fecha y hora</th>
                    <th>Imágenes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recomendaciones as $recomendacion)
                <tr class="recomendacion" data-fecha="{{ $recomendacion->created_at }}">
                    <td>{{ $recomendacion->nombre_medico }}</td>
                    <td>{{ $recomendacion->recomendacion }}</td>
                    <td>{{ $recomendacion->created_at }}</td>
                    <td>
                        <div class="d-flex flex-wrap">
                            @foreach ($recomendacion->diagnostico->ecografias as $imagen)
                                <img src="{{ asset($imagen->path) }}" alt="Ecografía" class="img-thumbnail m-2" style="max-width: 200px;">
                            @endforeach
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No hay recomendaciones registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Botón para imprimir -->
    <div class="text-center">
        <button id="btnImprimir" class="btn btn-primary" onclick="imprimirPagina()">Imprimir</button>
    </div>

    <!-- Script para imprimir y ocultar el botón -->
    <script>
        function imprimirPagina() {
            var btnImprimir = document.getElementById('btnImprimir');
            btnImprimir.style.display = 'none';
            window.print();
            btnImprimir.style.display = 'inline-block';
        }

        // Función para filtrar la tabla por fecha
        document.getElementById('start_date').addEventListener('change', filtrarTabla);
        document.getElementById('end_date').addEventListener('change', filtrarTabla);

        function filtrarTabla() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
            var rows = document.querySelectorAll('#tablaRecomendaciones tbody tr.recomendacion');

            rows.forEach(function(row) {
                var fecha = row.getAttribute('data-fecha');

                if (startDate && new Date(fecha) < new Date(startDate)) {
                    row.style.display = 'none';
                } else if (endDate && new Date(fecha) > new Date(endDate)) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        }
    </script>
</div>
@endsection
