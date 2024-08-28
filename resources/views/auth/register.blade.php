@extends('layouts.app')

@section('titulo')
    <h1 class="text-3xl font-black text-center">Ingresa a DevsTagram</h1><br><br>
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/logo.jpg') }}" alt="Imagen registar usuario" >             
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div  class="m-5">
                    <label id="name" class="mb-2 block uppercase text-gray-500 font-bold">
                            Nombre
                    </label>
                    <input id="name" name="name" type="text" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" placeholder="Nombre" value={{ old('name') }}>    
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                    @enderror  
                </div>
                <div class="m-5">
                    <label id="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de Usuario
                    </label>
                    <input id="username" name="username" type="text" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" placeholder="Nombre de Usuario" value={{ old('name') }}>
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                    @enderror
                </div>
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
                        Contraceña
                    </label>
                    <input id="password" name="password" type="password" class="border p-3 w-full rounded-lg" placeholder="Ingrese su contraceña"/>

                </div>
                <div class="m-5">
                    <label id="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Contraceña
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="borde p-3 w-full rounded-lg" placeholder="Repita su contraceña"/>

                </div>
                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>

        </div>
    </div>
    
@endsection