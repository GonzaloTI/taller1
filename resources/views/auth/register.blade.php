@extends('layouts.index')

@section('title', 'HepatoScan AI')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container px-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Contact form-->
            <div class="rounded-3 py-5 px-4 px-md-5 mb-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Registro</h1>
                    <p class="lead fw-normal text-muted mb-0">Ingresa tus datos personales</p>
                </div>
                
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <!-- CI input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ci" name="ci" type="text"
                                    placeholder="Ingresa tu CI..." value="{{ old('ci') }}" />
                                <label for="ci">CI</label>
                                @error('ci')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nombre" name="nombre" type="text"
                                    placeholder="Ingresa tu nombre..." value="{{ old('nombre') }}" />
                                <label for="nombre">Nombre</label>
                                @error('nombre')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Apellido Paterno -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_paterno" name="a_paterno" type="text"
                                    placeholder="Ingresa tu apellido paterno..." value="{{ old('a_paterno') }}" />
                                <label for="a_paterno">Apellido Paterno</label>
                                @error('a_paterno')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Apellido Materno -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_materno" name="a_materno" type="text"
                                    placeholder="Ingresa tu apellido materno..." value="{{ old('a_materno') }}" />
                                <label for="a_materno">Apellido Materno</label>
                                @error('a_materno')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Género -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="sexo" name="sexo">
                                    <option value="">Seleccione su género</option>
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                </select>
                                <label for="sexo">Género</label>
                                @error('sexo')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="telefono" name="telefono" type="tel"
                                    placeholder="Ingresa tu teléfono..." value="{{ old('telefono') }}" />
                                <label for="telefono">Teléfono</label>
                                @error('telefono')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="direccion" name="direccion" type="text"
                                    placeholder="Ingresa tu dirección..." value="{{ old('direccion') }}" />
                                <label for="direccion">Dirección</label>
                                @error('direccion')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre de usuario -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Ingresa tu nombre de usuario..." value="{{ old('name') }}" />
                                <label for="name">Nombre de usuario</label>
                                @error('name')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="name@example.com" value="{{ old('email') }}" />
                                <label for="email">Email address</label>
                                @error('email')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Create a password" />
                                <label for="password">Password</label>
                                @error('password')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmar Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password_confirmation" name="password_confirmation"
                                    type="password" placeholder="Confirm password" />
                                <label for="password_confirmation">Confirm password</label>
                                @error('password_confirmation')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button-->
                            <div class="d-grid">
                                <button class="btn btn-dark btn-lg" id="submitButton" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
