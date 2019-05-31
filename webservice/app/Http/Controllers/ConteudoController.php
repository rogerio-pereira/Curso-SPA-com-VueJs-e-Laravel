<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;

class ConteudoController extends Controller
{
    public function lista(Request $request)
    {
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);

        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function adicionar(Request $request)
    {
        $data = $request->all();
        $user = $request->user();

        //Validação

        $conteudo = new Conteudo();
        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : '#';
        $conteudo->link = $data['link'] ? $data['link'] : '#';
        $conteudo->data = date('Y-m-d H:i:s');

        $user->conteudos()->save($conteudo);
        
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);

        return ['status' => true, 'conteudos' => $conteudos];
    }
}
