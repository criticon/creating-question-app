<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use App\Http\Resources\JWTAuth as JWTAuthResource;

class AuthController extends Controller
{
    /**
     * API Register
     *
     * @param RegisterFormRequest $request
     * @return App\Http\Resources\JWTAuth
     */
    public function register(RegisterFormRequest $request)
    {
        $sUsername = $request->name;
        $sEmail = $request->email;
        $sPassword = bcrypt($request->password);

        // Create user
        $oUser = User::create(['name' => $sUsername, 'email' => $sEmail, 'password' => $sPassword]);

        return (new JWTAuthResource($oUser))->additional(['status' => 'success']);
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return App\Http\Resources\JWTAuth
     */
    public function login(LoginFormRequest $request)
    {
        $aCredentials = $request->only('email', 'password');

        // Try to get a token, i.e. to login
        if (! $sToken = JWTAuth::attempt($aCredentials)) {
            return (new JWTAuthResource($sToken))
                ->additional(['status' => 'error', 'message' => 'Invalid Credentials']);
        }

        return (new JWTAuthResource(Auth::user()))->additional(['status' => 'success', 'token' => $sToken]);
    }
}
