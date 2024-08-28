@extends('layouts.app')

@section('titulo')
 
@endsection

@section('contenido')

    @if ($posts->count())
        <div class="container mx-auto flex justify-center">
            <div style="" >
                @foreach ($posts as $post)
                    <div class="mx-auto p-6 mt-10" style="width: 700px">
                        <div class="p-5 flex items-center">
                            <img src="{{ $post->user->imagen ? asset('perfiles') . '/' . $post->user->imagen : asset('img/user.jpg') }}" alt="Foto de perfil de {{$post->user->username}}" class="w-10 h-10 rounded-full mr-3">
                            <a href="{{ route('post.index', $post->user->username) }}" class="font-bold">{{$post->user->username}}</a>
                        </div>
                        
                        <a>
                            <img class="w-full h-auto object-cover" src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                        </a>
                        <div class="flex items-center space-x-4">
                            <!-- Icono de Like -->
                            <div>
                                @auth
                                    @if ($post->checkLike(auth()->user()))
                                        <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <div class="my-4">
                                                <button type="submit" class="focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                            @csrf
                                            <div class="my-4">
                                                <button type="submit" class="focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        
                            <!-- Icono de Comentarios -->
                            <div class="my-4">
                                <button type="button" class="open-comments-modal focus:outline-none" data-post-id="{{ $post->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                    </svg>
                                </button>
                            </div>
                        
                            <!-- Icono de Compartir -->
                            <div class="my-4">
                                <button type="button" class="focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="comments-modal-{{ $post->id }}" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <div class="shadow bg-white p-5 mb-5">
                                    <p class="text-xl font-bold text-center mb-4">Comentarios</p>
                                    @if (session('mensaje'))
                                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                                            {{session('mensaje')}}
                                        </div>
                                    @endif
                                    @auth
                                        
                                    
                                    <form action="{{ route('comentarios.store', [auth()->user(), $post]) }}" method="POST">
                                        @csrf
                                        <div class="m-5">
                                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                                Comentario
                                            </label>
                                            <textarea id="comentario" name="comentario" class="border p-3 w-full rounded-lg " placeholder="Agrege un comentario"></textarea>
                                            @error('descripcion')
                                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 ">{{ $message }}</p>                        
                                            @enderror
                                        </div>
                                        <input type="submit" value="comentar" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                                    </form>
                                    @endauth
                                    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                                        @if ($post->comentarios->count())
                                            @foreach ($post->comentarios as $comentario)
                                                <div class="p-5 border-gray-300 border-b">
                                                    <a class="font-bold" href="{{ route('post.index', $comentario->user->username) }}">{{ $comentario->user->username }}</a>
                                                    <p>{{ $comentario->comentario }}</p>
                                                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="p-10 text-center">No hay comentarios aun</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                // Abre el modal
                                document.querySelectorAll('.open-comments-modal').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const postId = this.dataset.postId;
                                        // Cierra todos los modales abiertos
                                        document.querySelectorAll('.comments-modal').forEach(modal => {
                                            modal.classList.add('hidden');
                                        });
                                        // Muestra el modal correspondiente
                                        document.getElementById(`comments-modal-${postId}`).classList.remove('hidden');
                                        loadComments(postId);
                                        document.getElementById(`comment-form-${postId}`).action = `/posts/${postId}/comments`;
                                    });
                                });

                                // Cierra el modal
                                document.addEventListener('click', event => {
                                    if (event.target.classList.contains('close-modal')) {
                                        event.target.closest('.comments-modal').classList.add('hidden');
                                    }
                                });

                                // Cargar comentarios
                                function loadComments(postId) {
                                    fetch(`/posts/${postId}/comments`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const commentsList = document.getElementById(`comments-list-${postId}`);
                                            commentsList.innerHTML = '';
                                            data.comments.forEach(comment => {
                                                commentsList.innerHTML += `
                                                    <div class="mb-2 p-2 border-b">
                                                        <p class="font-bold">${comment.user.username}</p>
                                                        <p>${comment.text}</p>
                                                    </div>
                                                `;
                                            });
                                        });
                                }
                            });


                        </script>
                        
                        
                        <p class="font-bold">{{ $post->likes()->count() }} likes</p>
                        
                          
                        <div>
                            
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            <p class="mt-5">{{ $post->descripcion }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center">No hay posts para mostrar.</p>
    @endif

@endsection
