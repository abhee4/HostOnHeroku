<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(ApiRegisterRequest $request)
    {
        /**
         * * @var $user User
         */
        $user = User::create(
            [
                'first_name' => $request->first_name,
                'last_name'   => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
            ]
        );
        $token = $user->createToken('api_token')->accessToken;
        return response(
            [
                'user_id' => $user->id,
                'access_token' => $token,
            ]
        );
    }
    public function login(ApiLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $authaAttempt = auth()->attempt($credentials);

        if (!$authaAttempt) {
            return response([
                'error' => 'forbidden',
                'message' => 'Check your Username or Password'
            ], 403);
        }
        $token = auth()->user()->createToken('api_token')->accessToken;
        return response(
            [
                'user_id' => auth()->id(),
                'access_token' => $token,
            ]
        );
    }
}
