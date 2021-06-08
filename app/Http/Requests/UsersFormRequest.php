<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O Campo :attribute é Obrigatório',
            'name.min' => 'O Nome precisa ter pelo menos 3 caracteres',
            'name.unique' => 'Já existe usário com o mesmo nome',
            'email.unique' => 'O e-mail já está sendo utilizado',
        ];

    }
}
