<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function cadastro(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                    ]);

        if($validacao->fails())
            return [
                'status' => false,
                'validacao' => true,
                'erros' => $validacao->errors()
            ];

        $imagem = '/perfils/padrao.png';
        $data['imagem'] = $imagem;

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->token = $user->createToken($user->email)->accessToken;

        //$user->imagem = asset($user->imagem); 
            
        return ['status' => true, 'usuario' => $user];
    }

    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
                        'email' => 'required|string|email|max:255',
                        'password' => 'required|string',
                    ]);

        if($validacao->fails())
            return [
                    'status' => false,
                    'validacao' => true,
                    'erros' => $validacao->errors()
                ];

        if(Auth::attempt($data)) {
            $user = auth::user();
            $user->token = $user->createToken($user->email)->accessToken;
        
            //$user->imagem = asset($user->imagem); 
            
            return ['status' => true, 'usuario' => $user];
        }
        else
            return ['status' => false];
    }

    public function perfil(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        //Validação com Senha
        if(isset($data['password'])) {
            $validacao = Validator::make($data, [
                            'name' => 'required|string|max:255',
                            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
                            'password' => 'required|string|min:6|confirmed',
                        ]);

            $user->password = bcrypt($data['password']);
        }
        //Validação sem senha
        else {
            $validacao = Validator::make($data, [
                            'name' => 'required|string|max:255',
                            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
                        ]);
        }

        if($validacao->fails())
            return [
                'status' => false,
                'validacao' => true,
                'erros' => $validacao->errors()
            ];

        $user->name = $data['name'];
        $user->email = $data['email'];

        //Imagem
        if(isset($data['imagem'])) {
            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator){
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'jpeg', 'svg'];
                $format = str_replace([
                                        'data:image/', 
                                        ';',
                                        'base64',
                                    ],
                                    [
                                        '', '', '',
                                    ],
                                    $explode[0]
                                );

                //Check file format
                if(!in_array($format, $allow)) {
                    return false;
                }

                //Check base64 format
                if(!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }

                return true;
            });


            $validacao = Validator::make($data, [
                                'imagem' => 'base64image',
                            ],
                            [
                                'base64image' => 'Imagem inválida'
                            ]);

            if($validacao->fails())
                return [
                    'status' => false,
                    'validacao' => true,
                    'erros' => $validacao->errors()
                ];

            $time = time();
            $diretorioPai = 'perfils';
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;

            //Pegar extensão da imagem
            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') -11);
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;

            $file = str_replace('data:image/'.$ext.';base64,', '', $data['imagem']);
            $file = base64_decode($file);

            if($user->imagem){
                $imgUser = $user->imagem;
                $imgUser = str_replace(asset('/'), '', $imgUser);

                if(file_exists($imgUser)) {
                    Storage::delete($imgUser);
                }
            }

            Storage::put($urlImagem, $file);

            $user->imagem = $urlImagem; 
        }

        $user->save();

        //$user->imagem = asset($user->imagem); 
        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, 'usuario' => $user];
    }

    public function amigo(Request $request)
    {
        $user = $request->user();
        $amigo = User::find($request->id);

        if($amigo && ($user->id != $amigo->id)) {
            $user->amigos()->toggle($amigo->id);

            return ['status' => true, 'amigos' => $user->amigos];
        }
        else {
            return ['status' => false, 'erro' => 'Esse usuário não existe!'];
        }
    }

    public function listaAmigos(Request $request)
    {
        $user = $request->user();

        if($user) {
            return ['status' => true, 'amigos' => $user->amigos];
        }
        else
            return ['status' => false, 'erro' => 'Esse usuário não existe!'];
    }

    public function listaAmigosPagina($id, Request $request)
    {
        $user = User::find($request->id);
        $usuarioLogado = $request->user();

        if($user) {
            return ['status' => true, 'amigos' => $user->amigos, 'amigosLogado' => $usuarioLogado->amigos];
        }
        else
            return ['status' => false, 'erro' => 'Esse usuário não existe!'];
    }
}
