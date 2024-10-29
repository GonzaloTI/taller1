    @extends('layouts.index')

    @section('content')
    <h1 class="text-center" style="font-weight: bold;" class="mb-4">Historial médico</h1>
    <div class="container">
        <h1 class="text-center" style="font-weight: bold;" class="mb-4">Historial médico</h1>

        @if ($diagnosticos->isEmpty())
        <div class="alert alert-info mt-4" role="alert">
            No se encontraron diagnósticos en el historial.
        </div>
        @else
        <div class="list-group">
            
            @foreach ($diagnosticos as $diagnostico)
            
            <div class="list-group-item mb-3 p-4 shadow-sm">
            <div class="mt-3">
                    <strong>Ecografia:</strong>
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
                    <br>
                    <!-- <strong>Apellido:</strong> 
                    {{ $diagnostico->medico->a_paterno }}
                    <br> -->
                    <!-- {{ $diagnostico->medico->a_materno }} -->
                    <!-- <small>{{ $diagnostico->medico->especialidad }}</small> -->
                </div>
                
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endsection
