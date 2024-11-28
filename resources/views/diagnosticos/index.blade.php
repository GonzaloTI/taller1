@extends('layouts.index')

@section('content')
<h1 class="text-center" style="font-weight: bold;" class="mb-4">Historial médico</h1>
<div class="container">
    <h1 class="text-center" style="font-weight: bold;" class="mb-4">Historial médico</h1>

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

    @if ($diagnosticos->isEmpty())
    <div class="alert alert-info mt-4" role="alert">
        No se encontraron diagnósticos en el historial.
    </div>
    @else
    <div class="list-group" id="historialMedico">
        @foreach ($diagnosticos as $diagnostico)
        <div class="list-group-item mb-3 p-4 shadow-sm historial" data-fecha="{{ $diagnostico->created_at }}">
            <div class="mt-3">
                <strong>Ecografía:</strong>
                <div class="d-flex flex-wrap">
                    @foreach ($diagnostico->ecografias as $ecografia)
                    <div class="p-2">
                        <img src="{{ asset($ecografia->path) }}" alt="Ecografía" class="img-thumbnail" style="max-width: 400px; height: auto;">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="resultado-ia-{{ $diagnostico->id }}" class="form-label"><strong>Resultado de la IA:</strong></label>
                <textarea id="resultado-ia-{{ $diagnostico->id }}" class="form-control" rows="5" readonly>{{ $diagnostico->resultado_ia }}</textarea>
                <label for="resultado-ia-{{ $diagnostico->id }}" class="form-label"><strong>Resultado Por el Especialista:</strong></label>
                <textarea id="resultado-{{ $diagnostico->id }}" class="form-control" rows="3" readonly>{{ $diagnostico->resultado}}</textarea>
            </div>
            
            <div class="mb-2">
                <strong>Fecha y Hora:</strong> {{ $diagnostico->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div>
                <strong>Nombre del médico:</strong> 
                {{ $diagnostico->medico->name }} 
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Script para filtrar el historial médico por fechas -->
<script>
    document.getElementById('start_date').addEventListener('change', filtrarHistorial);
    document.getElementById('end_date').addEventListener('change', filtrarHistorial);

    function filtrarHistorial() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var items = document.querySelectorAll('#historialMedico .historial');

        items.forEach(function(item) {
            var fecha = item.getAttribute('data-fecha');

            if (startDate && new Date(fecha) < new Date(startDate)) {
                item.style.display = 'none';
            } else if (endDate && new Date(fecha) > new Date(endDate)) {
                item.style.display = 'none';
            } else {
                item.style.display = '';
            }
        });
    }
</script>

@endsection
