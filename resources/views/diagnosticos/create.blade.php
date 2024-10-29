@extends('layouts.app')

@section('content')
<div class="container">
      <!-- Mostrar mensaje de éxito -->
      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <!-- Mostrar mensaje de error general -->
  @if(session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
  @endif

  <!-- Mostrar errores de validación específicos -->
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <h1 class="text-center">Crear Nuevo Diagnóstico</h1>
    
    <!-- Formulario para solicitar diagnóstico -->
    <form method="POST" action="{{ route('diagnosticos.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Campo oculto para el user_id -->
        <input type="hidden" id="user_id" name="user_id">

        <div class="form-group">
            <label for="ci">CI:</label>
            <input type="number" class="form-control" id="ci" name="ci" placeholder="Número de CI" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-group">
            <label for="a_paterno">Apellido Paterno:</label>
            <input type="text" class="form-control" id="a_paterno" name="a_paterno" placeholder="Apellido Paterno" required>
        </div>
        <div class="form-group">
            <label for="a_materno">Apellido Materno:</label>
            <input type="text" class="form-control" id="a_materno" name="a_materno" placeholder="Apellido Materno" required>
        </div>

        <input type="file" class="form-control" id="imagen" name="imagen" style="display: none;">
        <label for="imagen" class="btn btn-primary">Agregar imagen</label>

        <!-- Contenedor para la vista previa de la imagen -->
        <div id="image-preview" class="d-flex justify-content-center mt-3">
            <div id="image-list"></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Diagnóstico</button>


        <a href="" class="btn btn-secondary">Analizar Imagen IA</a>

    </form>

 
    <!-- Tabla de Clientes -->
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Seleccionar Cliente</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Carnet</th>
                                <th>Nombre</th>
                                <th>A_paterno</th>
                                <th>A_materno</th>
                                <th>Sexo</th>
                                <th>Estado</th>
                                <th>User_Id</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                            <tr>
                                <td class="py-3 px-7">{{$row->id}}</td>
                                <td class="p-3">{{$row->ci}}</td>
                                <td class="p-3 text-center">{{$row->nombre}}</td>
                                <td class="p-3 text-center">{{$row->a_paterno}}</td>
                                <td class="p-3 text-center">{{$row->a_materno}}</td>
                                <td class="p-3 text-center">{{$row->sexo}}</td>   
                                <td class="p-3 text-center">{{$row->estado}}</td>
                                <td class="p-3 text-center">{{$row->user_id}}</td>
                                <td class="p-3">
                                    <button class="btn btn-primary btn-sm" onclick="selectClient({{ $row }})">Seleccionar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectClient(client) {
        // Llenar el formulario con los datos del cliente seleccionado
        document.getElementById('ci').value = client.ci;
        document.getElementById('nombre').value = client.nombre;
        document.getElementById('a_paterno').value = client.a_paterno;
        document.getElementById('a_materno').value = client.a_materno;
        document.getElementById('user_id').value = client.id; // Guardar el user_id en el campo oculto
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('imagen').addEventListener('change', function(e) {
            document.getElementById('image-list').innerHTML = '';

            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Image preview';
                img.classList.add('img-fluid', 'rounded', 'mt-2'); // Agregar clases para estilizar la imagen
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                document.getElementById('image-list').appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection
