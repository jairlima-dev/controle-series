<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'success' => false,
                'errors' => ['user' => ['Usário ou Senha inválidos!']]],
                401);
        }
        $user = auth()->user();

        return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);

    }

    public function register(Request $request)
    {

        $data = $request->validate(
            [
                'name' => 'required|min:3|max:20|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();

        return response()->json(['success' => true, 'user' => $user], 200);
    }

    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

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
