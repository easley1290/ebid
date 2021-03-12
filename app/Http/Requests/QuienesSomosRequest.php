<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuienesSomosRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'inputNombre' => 'required|min:7',
            'inputFrase' => 'required|min:8',
            'inputMision' => 'required',
            'inputVision' => 'required',
            'inputObjetivo' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'inputNombre:required' => 'Añade un nombre',
            'inputNombre:min' => 'El numero de caracteres debe ser mayor a 8',
            'inputFrase:required' => 'Añade una frase para la institucion',
            'inputFrase:min' => 'EL numero de caracteres debe ser mayor a 8',
            'inputMision:required' => 'Añade la mision de la institucion',
            'inputVision:required' => 'Añade la vision de la institucion',
            'inputObjetivo:required' => 'Añade el objetivo de la institucion'
        ];
    }
}
