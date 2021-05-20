<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:3',
            'assistido' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é Obrigatório',
            'nome.min' => 'O Nome precisa ter pelo menos 3 caracteres',
            'nome.unique' => 'Já existe um Episódio com o mesmo nome',
        ];
    }

}
