<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwtauth')->except('login', 'register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => ['user' => ['Usário ou Senha inválidos!']]],
                401);
        }

        $user = auth()->user();

        return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);

    }

    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);

    }

    public function checkToken(Request $request)
    {
        return response()->json(['success' => true], 200);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['success' => true], 200);
    }

}
