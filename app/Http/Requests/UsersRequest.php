<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersRequest extends FormRequest
{
    /**
     * Verifica se a validação é verdadeira ou falsa
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Array de campos obrigatórios do conteúdo
     *
     * @return array
     */
    public function rules(Request $request)
    {   
        switch(true) {
            case $request->isMethod('post'):
                $rules =  [
                    'name' => 'required',
                    'email' => 'required|email',
                    'username' => 'required',
                    'role_id' => 'required',
                    'password' => 'required|confirmed',
                    'status' => 'required',
                ]; 
                break;
            case $request->isMethod('put'):
                $rules =  [
                    'name' => 'required',
                    'email' => 'required',
                    'username' => 'required',
                    'password' => 'confirmed',
                    'status' => 'required',
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
            'name.required' => 'Nome obrigatório',
            'email.required' => 'Digite o e-mail',
            'email.email' => 'Digite um e-mail válido',
            'username.required' => 'Nome de usuário obrigatório',
            'role_id.required' => 'Escolha o tipo do usuário',
            'status.required' => 'Status do usuário obrigatório',
            'password.required' => 'Senha obrigatória',
            'password.confirmed' => 'A senha e confirmação de senha não coincidem'
        ];
    }
}