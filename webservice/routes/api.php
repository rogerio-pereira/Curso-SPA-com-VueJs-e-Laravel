<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});


Route::post('/cadastro', function (Request $request) {
    $data = $request->all();

    $validacao = Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                ]);

    if($validacao->fails())
        return $validacao->errors();

    $data['password'] = bcrypt($data['password']);
    $user = User::create($data);
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::post('/login', function (Request $request) {
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
    
        return $user;
    }
    else
        return ['status' => false];
});

Route::middleware('auth:api')->put('/perfil', function (Request $request) {
    $user = $request->user();
    $data = $request->all();

    return $data;
});