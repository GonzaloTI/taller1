@extends('layouts.index')

@section('title', 'HepatoScan AI')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container px-5">
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
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nombre" name="nombre" type="text"
                                    placeholder="Ingresa tu nombre..." data-sb-validations="required" />
                                <label for="nombre">Nombre</label>
                                <div class="invalid-feedback" data-sb-feedback="nombre:required">A name is required.</div>
                                @error('nombre')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Last name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_paterno" name="a_paterno" type="text"
                                    placeholder="Ingresa tu apellido paterno..." data-sb-validations="required" />
                                <label for="a_paterno">Apellido Paterno</label>
                                <div class="invalid-feedback" data-sb-feedback="a_paterno:required">A last name is required.</div>
                                @error('a_paterno')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Second last name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_materno" name="a_materno" type="text"
                                    placeholder="Ingresa tu apellido materno..." data-sb-validations="required" />
                                <label for="a_materno">Apellido Materno</label>
                                <div class="invalid-feedback" data-sb-feedback="a_materno:required">A second last name is required.</div>
                                @error('a_materno')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender input (Select)-->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="sexo" name="sexo" required>
                                  
                                    <option value="femenino">Femenino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                                <label for="sexo">Género</label>
                                <div class="invalid-feedback" data-sb-feedback="sexo:required">Género requerido</div>
                                @error('sexo')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- CI input (Only numbers allowed)-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ci" name="ci" type="text"
                                    placeholder="Ingresa tu CI..." pattern="\d*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    required data-sb-validations="required" />
                                <label for="ci">CI</label>
                                <div class="invalid-feedback" data-sb-feedback="ci:required">A CI is required.</div>
                                @error('ci')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="telefono" name="telefono" type="tel"
                                    placeholder="Ingresa tu telefono..." data-sb-validations="required" />
                                <label for="telefono">Teléfono</label>
                                <div class="invalid-feedback" data-sb-feedback="telefono:required">A phone number is required.</div>
                                @error('telefono')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="direccion" name="direccion" type="text"
                                    placeholder="Ingresa tu direccion..." data-sb-validations="required" />
                                <label for="direccion">Dirección</label>
                                <div class="invalid-feedback" data-sb-feedback="direccion:required">A address is required.</div>
                                @error('direccion')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Ingresa tu nombre de usuario..." data-sb-validations="required" />
                                <label for="name">Nombre de usuario</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A username is required.</div>
                                @error('name')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com"
                                    data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                                @error('email')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Create a password" data-sb-validations="required" />
                                <label for="password">Password</label>
                                <div class="invalid-feedback" data-sb-feedback="password:required">A password is required.</div>
                                @error('password')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password confirmation input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password_confirmation" name="password_confirmation"
                                    type="password" placeholder="Confirm password" data-sb-validations="required" />
                                <label for="password_confirmation">Confirm password</label>
                                <div class="invalid-feedback" data-sb-feedback="password_confirmation:required">A password confirmation is required.</div>
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
