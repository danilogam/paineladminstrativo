<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EstadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**
     * Array de campos obrigatórios do conteúdo
     *
     * @return array
     */
    public function rules(Request $request) 
    {   
        switch(true) {
            case $request->isMethod('post'):
            case $request->isMethod('put'):
                $rules =  [
                    'nome' => 'required',
                    'sigla' => 'required', 
                ]; 
                break; 
        } 
        return $rules; 
    }

    /**
     * Array de mensagens personalizadas dos campos obrigatórios
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'Nome do estado obrigatório',
            'sigla.required' => 'Sigla do estado obrigatório', 
        ];
    }
}
