<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        // Validar la contraseña actual
        if($request->current_password)
        {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
            }
        }
        
        
        $request->request->add(['username' => Str::slug( $request->username)]);
        

        $this->validate( $request, [
            'username' => ['required', 'unique:users,username,' .auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter, editar-perfil'],
            'email' => ['required', 'email', 'max:60', 'unique:users,email,' . auth()->user()->id],
            'new_password' => ['nullable', 'min:8'],
        ]);

        if($request->imagen)
        {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." .  $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);           
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        if ($request->new_password) {
            $usuario->password = Hash::make($request->new_password);
        }
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        
        
        $usuario->save();

        return redirect()->route('post.index', $usuario->username);
    }
}
