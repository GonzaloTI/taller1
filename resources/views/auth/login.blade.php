@extends('layouts.index')

@section('title', 'Login')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card-body p-4 p-lg-5 text-black">
                        <form method="POST" action="">
                            @csrf
                            <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Iniciar Sesión
                            </h5>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Correo Electronico</label>
                                <input type="email" placeholder="example@gmail.com" id="email" name="email"
                                    class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg" />
                            </div>

                            @error('message')
                                <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">
                                    {{ $message }}</p>
                            @enderror

                            <div class="pt-1 mb-4">
                                <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <a class="small text-muted" href="#!">Recuperar Contraseña</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                    style="color: #393f81;">Registrate Aquí</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
