<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome' => "required|min:3|unique:series",
            'temporadas' => 'required|numeric',
            'episodios' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O Campo :attribute é Obrigatório',
            'nome.min' => 'O Nome precisa ter pelo menos 3 caracteres',
            'nome.unique' => 'Já existe uma Série com o mesmo nome',
            'temporadas.numeric' => 'O Campo :attribute precisa ser numérico',
            'episodios.numeric' => 'O Campo :attribute precisa ser numérico'
        ];
    }
}
