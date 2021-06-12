<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwtauth');

    }

    public function index()
    {
        return UserResource::collection(User::orderBy('name')
            ->paginate(8));
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if (!$user = User::create($data)) {
            return response()->json([
                'success' => false,
                'user' => ['Não foi possível efetuar a solicitação ']], 200);
        }

        return response()->json([
            'success' => true,
            'user' => $user], 200);

    }

    public function destroy(User $user)
    {
        if (!$user->delete()) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    private function validateForm(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:4|max:20|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
            ],
            [
                'required' => 'O Campo :attribute é Obrigatório',
                'name.min' => 'O Nome precisa ter pelo menos 4 caracteres',
                'name.max' => 'O Nome não pode ser maior que 20 caracteres',
                'name.unique' => 'Já existe usário com o mesmo nome',
                'email.unique' => 'O e-mail já está sendo utilizado',
                'email' => 'O email precisa ter um formato válido',
                'password.min' => 'A Senha precisa ter 6 caracteres ou mais',
                'c_password.same' => 'Senhas não conferem'
            ]);

        return $request;

    }
}
