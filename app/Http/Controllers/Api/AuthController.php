<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwtauth')->except('login');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => ['user' => ['Usário ou Senha inválidos!']]
            ], 401);
        }

        $user = auth()->user();
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user], 200);

    }

    public function getUser()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

    public function checkToken()
    {
        return response()->json(['success' => true], 200);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['success' => true], 200);
    }

}
