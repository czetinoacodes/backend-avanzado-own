<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email'  => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',

        ]);

        $user = User::create([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
            'role'  => 'user',
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

                                        //cliente            //DB
        if(! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Credenciales invalidas'], 401);
        }

        return response()->json(['message' => 'Login exitoso', 'user' => $user], 200);
    }

    public function me(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        return response()->json($user);
    }

    public function meByEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        return response()->json($user);
    }

}