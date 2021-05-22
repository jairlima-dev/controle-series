<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'assistido' => 'boolean',
            'nome' => [
                'required',
                'min:3',
//                Rule::unique('episodios')
//                    ->where('temporada_id', $this->temporada_id)
            ]
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
