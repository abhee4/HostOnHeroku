<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::post('register', 'Api\\Auth\\AuthController@register');
Route::post('login', 'Api\\Auth\\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResource($request-> user());
});
