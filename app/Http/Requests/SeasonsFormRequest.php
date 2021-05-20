<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonsFormRequest extends FormRequest
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
            'serie_id' => 'required|numeric',
            'episodios' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O Campo :attribute é Obrigatório',
            'series_id.numeric' => 'O Campo :attribute precisa ser numérico',
            'episodios.numeric' => 'O Campo :attribute precisa ser numérico'
        ];
    }
}
