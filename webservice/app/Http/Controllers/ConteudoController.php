<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;
use Illuminate\Support\Facades\Validator;

class ConteudoController extends Controller
{
    public function lista(Request $request)
    {
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        $user = $request->user();

        foreach($conteudos as $conteudo) {
            $conteudo->comentarios = $conteudo->comentarios()->with('user')->get();
            $conteudo->curtidas = $conteudo->curtidas()->count();

            $curtiu = $user->curtidas()->find($conteudo->id);

            if($curtiu)
                $conteudo->curtiuconteudo = true;
            else
                $conteudo->curtiuconteudo = false;
        }

        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function adicionar(Request $request)
    {
        $data = $request->all();
        $user = $request->user();

        //Validação

        $validacao = Validator::make($data, [
            'titulo' => 'required',
            'texto' => 'required',
        ]);

        if($validacao->fails())
            return [
                'status' => false,
                'validacao' => true,
                'erros' => $validacao->errors()
            ];

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

    public function curtir($id, Request $request)
    {
        $conteudo = Conteudo::find($id);
        if($conteudo) {
            $user = $request->user();
            
            $user->curtidas()->toggle($conteudo->id);

            return [
                'status' => true, 
                'curtidas' => $conteudo->curtidas()->count(),
                'lista' => $this->lista($request),
            ];
        }
        else
            return ['status' => false, 'erro' => 'Conteúdo não existe!'];
    }
}
