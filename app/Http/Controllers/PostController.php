<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    public function index( User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        $posts = $user->posts()->latest()->paginate(8);
       
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');    
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo' => 'required|max:80',
            'descripcion' => 'required',
        ]);
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);
        
        return redirect()->route('post.index', auth()->user()->username);
    }

    public function destroy(Post $post, User $user)
    {
        if($post->user_id === auth()->user()->id)
        {
            $this->authorize('delete', $post);
            $post->delete();

            return redirect()->route('post.index', auth()->user()->username);
        }


        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
            File::delete();
        }
    }

}
