@extends('layouts.app')

@section('titulo')
    Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div  class="m-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                    </label>
                    <input id="username" name="username" type="text" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" placeholder="Tu nombre de usuario" value={{auth()->user()->username}}>    
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                    @enderror  
                </div>
                <div class="m-5">
                    <label id="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" placeholder="Ingrese su correo" value={{auth()->user()->email}}>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                    @enderror
                </div>
                <div class="m-5">
                    <label for="current_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraceña actual
                    </label>
                    <input id="current_password" name="current_password" type="password" class="border p-3 w-full rounded-lg" placeholder="Ingrese su contraceña actual"/>

                </div>
                <div class="m-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraceña nueva
                    </label>
                    <input id="new_password" name="new_password" type="password" class="borde p-3 w-full rounded-lg" placeholder="Ingrese su nueva contraceña"/>

                </div>
                <div  class="m-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                            Imagen de perfil
                    </label>
                    <input id="imagen" name="imagen" type="file" accept=".jpg, .png, .jpeg" class="border p-3 w-full rounded-lg" value="">    
                    
                </div>
                <input type="submit" value="guardar cambios" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection