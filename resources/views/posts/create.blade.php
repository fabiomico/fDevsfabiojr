@extends('layouts.app')

@section('titulo')
        Post
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
@endpush

@section('contenido')


    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="md:w-1/2  px-10">
                <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                    @csrf
                </form>
            </div>
            <div class="md:w-1/2 px-10 bg-white p-6 rounded-lg shadow-xl mt-10 md:mt-0">
                <form action="{{ route('posts.store') }}" method="POST" novalidate>
                    @csrf
                    <div  class="m-5">
                        <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                                Titulo
                        </label>
                        <input id="titulo" name="titulo" type="text" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" placeholder="Titulo de la publicacion" value={{ old('titulo') }}>    
                        @error('titulo')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                        @enderror  
                    </div>
                    <div class="m-5">
                        <input type="hidden" name="imagen" id="imagen" value={{ old('imagen') }}>
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                        @enderror
                    </div>
                    <div class="m-5">
                        <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                            Descripcion
                        </label>
                        <textarea id="descripcion" name="descripcion" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror" placeholder="descripcion de la publicacion"> {{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                        @enderror
                    </div>
                    <input type="submit" value="Crear Post" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
        </div>
    </div>
    
    
@endsection