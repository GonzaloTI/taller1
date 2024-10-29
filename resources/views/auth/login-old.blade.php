@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="block mx-auto my-12 p-8 bg-white w-1/2 borderr border-gray-200 rounded-lg shadow-lg">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 90rem;" src="   " alt="...">
        <h1 class="text-3xl text-center font-bold"> Interpretador de Ecografias </h1>

        <form class="mt-4" method="POST" action="">
            @csrf
            <input type="email"
                class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Email" id="email" name="email">
            <input type="password"
                class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Contraseña" id="password" name="password">

            @error('message')
                <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
            @enderror


            <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-100" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                Entrar
            </button>
        </form>
    </div>
@endsection
