<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/cadastro', 'UsuarioController@cadastro');
Route::post('/login', 'UsuarioController@login');
Route::middleware('auth:api')->put('/perfil', 'UsuarioController@perfil');
Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/lista', 'ConteudoController@lista');
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', 'ConteudoController@curtir');
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', 'ConteudoController@comentar');

Route::middleware('auth:api')->get('/conteudo/pagina/lista/{id}', 'ConteudoController@pagina');

Route::get('/testes', function(){
    /*$user = App\User::find(1);
    $user2 = App\User::find(3);*/

    /*$conteudo = App\Conteudo::find(12);
    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Show de bola',
        'data' => date('Y-m-d H:i:s'),
    ]);
    return $conteudo->comentarios;*/

    //Apagando Conteudos
    /*$conteudos = App\Conteudo::all();
    foreach($conteudos as $conteudo)
    {
        $conteudo->delete();
    }*/
    
    //Cria Conteudo
    /*$user->conteudos()->create([
        'titulo' => 'Conteudo 3',
        'texto' => 'Aqui o texto',
        'imagem' => 'URL da imagem',
        'link' => 'Link',
        'data' => date('Y-m-d'),
    ]);

    return $user->conteudos;*/

    
    //Adiciona Amigo
    //$user->amigos()->attach($user2);
    //Remover Amigo
    //$user->amigos()->detach($user2);
    //Adicionar/remove amigo
    //$user->amigos()->toggle($user2);
    //return $user->amigos;



    //Adiciona Curtida
    /*$conteudo = App\Conteudo::find(1);
    $user->curtidas()->toggle($conteudo->id);
    //return $conteudo->curtidas()->count();
    return $conteudo->curtidas;*/



    //Adiciona Comentario
    /*$conteudo = App\Conteudo::find(1);
    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Show de bola',
        'data' => date('Y-m-d'),
    ]);
    $user2->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Não gostei',
        'data' => date('Y-m-d'),
    ]);
    return $conteudo->comentarios;*/
});