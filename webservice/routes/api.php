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
Route::middleware('auth:api')->get('/usuario', 'UsuarioController@usuario');
Route::middleware('auth:api')->put('/perfil', 'UsuarioController@perfil');

Route::get('/testes', function(){
    $user = App\User::find(1);
    
    //Cria Conteudo
    /*$user->conteudos()->create([
        'titulo' => 'Conteudo 3',
        'texto' => 'Aqui o texto',
        'imagem' => 'URL da imagem',
        'link' => 'Link',
        'data' => date('Y-m-d'),
    ]);

    return $user->conteudos;*/
});