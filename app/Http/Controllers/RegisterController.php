<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug( $request->username)]);

        $this->validate($request ,[
            'name' => 'required|max:30',
            'username' => 'required|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => hash::make($request->password),
        ]);

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }
}
