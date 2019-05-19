<?php

use App\User;
use Illuminate\Http\Request;

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
    $data['password'] = bcrypt($data['password']);

    $user = User::create($data);
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});