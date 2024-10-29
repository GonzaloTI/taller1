@extends('layouts.index')

@section('title', 'IA Online')

@section('content')
    <!-- Page content-->
    <section class="mt-5" style="height: 100%">
        {{-- Crear 3 columnas una de 2, 6 y 4 tambien pintarlas --}}
        <div class="row">
            <div class="col-2" style="background-color:black;"> <!-- Columna de tamaño 2 -->
                <!-- Contenido de la columna -->
                {{-- Aqui crear un card con un boton arriba que diga subir imagen, el card debe ocupar todo el alto de la pagina --}}
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        <form method="POST" action="{{ route('diagnosticos.api.enviar') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control" id="imagen" name="imagen" style="display: none;">
                            <label for="imagen" class="btn btn-primary">Agregar imagen</label>
                            <div class="form-group">
                            <label for="medico">Médico:</label>
                            <select class="form-control" id="medico" name="medico">
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}">
                                        {{ $medico->nombre }} {{ $medico->a_paterno }} {{ $medico->a_materno }} - {{ $medico->especialidad }} - {{ $medico->telefono }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                                            
                        
                            <button type="submit" class="btn btn-primary">Solicitar Diagnóstico</button>
                        </form>
                    </div>
                 
                </div>

            </div>
            <div class="col-6" style="background-color:black;"> <!-- Columna de tamaño 6 -->
                <!-- Contenido de la columna -->
                {{-- Aqui crear un card que ocupe todo el ancho y alto de la pagina --}}
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        Resultado
                    </div>
                   <!-- <div class="card-body">
                        <img src="https://via.placeholder.com/800x600" class="img-fluid" alt="...">
                    </div>-->
                    <div class="img-fluid" id="image-list" style="height: 900px; overflow-y: auto;">
                        <!-- Las imágenes se agregarán aquí -->
                    </div>
                </div>
            </div>
            <div class="col-4" style="background-color: #f7fdf8;"> <!-- Columna de tamaño 4 -->
                <!-- Contenido de la columna -->
               
                <p>Obtenga un resultado rapido y eficaz con la ayuda de Inteligencia Artificial y de profesionales</p>
                 <h2>Instrucciones:
                </h2>
                <p>enviar la imagen de su ecografia </p>
                <p>se procesara la imagen mediante un mecanismo de Reconocimiento de imagen por IA </p>
                <p>los resultados seran enviados a un profecional segun su plan de suscripcion </p>
                <p>la revision por un profesional sera pronta </p>
                <p>se le daran recomendaciones y un diagnostico segun el profesional designado </p>
                <p>gracias por usar el servicio </p>
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('imagen').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Image preview';
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                document.getElementById('image-list').appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
