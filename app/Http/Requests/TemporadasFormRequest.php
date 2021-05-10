<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemporadasFormRequest extends FormRequest
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
//            'numero' => 'required',
            'serie_id' => 'required|int',
            'episodios' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O Campo :attribute é Obrigatório',
            'series_id.int' => 'O Campo :attribute precisa ser numérico',
            'episodios.int' => 'O Campo :attribute precisa ser numérico'
        ];
    }
}
