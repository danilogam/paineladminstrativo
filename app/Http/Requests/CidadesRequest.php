<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CidadesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules(Request $request)
    {   
        switch(true) {
            case $request->isMethod('post'):
            case $request->isMethod('put'):
                $rules =  [
                    'nome' => 'required',
                    'estado_id' => 'required', 
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
            'nome.required' => 'Nome da cidade obrigatório',
            'estado_id.required' => 'Escolher o estado é obrigatório', 
        ];
    }
}
