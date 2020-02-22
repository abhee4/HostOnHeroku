<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use Illuminate\Support\Facades\Hash;
use app\User;

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
    }
}
