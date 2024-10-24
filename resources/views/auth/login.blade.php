@extends('layouts.app')

@section('titulo')
    <h1 class="text-3xl font-black text-center">Registrate fabiomivo jjj en DevsTagram</h1><br><br>
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/logo.jpg') }}" alt="Imagen registar usuario" >             
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ session('mensaje') }}</p>
                    
                @endif
                <div class="m-5">
                    <label id="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" placeholder="Ingrese su correo"/>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                    @enderror
                </div>
                <div class="m-5">
                    <label id="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraceñalllll
                    </label>
                    <input id="password" name="password" type="password" class="border p-3 w-full rounded-lg" placeholder="Ingrese su contraceña"/>

                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class="text-gray-500 text-sm"> Mantener mi sesion abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>

        </div>
    </div>
    
@endsection