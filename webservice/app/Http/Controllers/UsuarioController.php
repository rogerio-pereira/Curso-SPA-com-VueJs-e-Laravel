<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
                        'email' => 'required|string|email|max:255',
                        'password' => 'required|string',
                    ]);

        if($validacao->fails())
            return $validacao->errors();

        if(Auth::attempt($data)) {
            $user = auth::user();
            $user->token = $user->createToken($user->email)->accessToken;
        
            $user->imagem = asset($user->imagem); 
            return $user;
        }
        else
            return ['status' => false];
    }
}
