<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
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

        $http = new Client();

        $response = $http->post( url('/').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '302',
                'client_secret' => 'FlR0NunsVDJikmXLJU8jxlsUqivdPuiOveALUOMc',
                'username' => $user->email,
                'password' => $user->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
        // $token = $user->createToken('api_token')->accessToken;
        // return response(
        //     [
        //         'user_id' => $user->id,
        //         'access_token' => $token,
        //     ]
        // );
    }
    public function login(ApiLoginRequest $request)
    {
        return $request;
        $credentials = $request->only(['email', 'password']);
        $authAttempt = auth()->attempt($credentials);

        if (!$authAttempt) {
            return response([
                'error' => 'forbidden',
                'message' => 'Check your Username or Password'
            ], 403);
        }
        $http = new Client();

        $response = $http->post( url('/').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '302',
                'client_secret' => 'FlR0NunsVDJikmXLJU8jxlsUqivdPuiOveALUOMc',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);

        // $token = auth()->user()->createToken('api_token')->accessToken;
        // return response(
        //     [
        //         'user_id' => auth()->id(),
        //         'access_token' => $token,
        //     ]
        // );
    }
}
