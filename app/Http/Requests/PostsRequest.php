<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'=>'required',
            'categoria_id'=>'required',
            'content'=>'required',
        ];
    }

    /**
     * Array de mensagens personalizadas dos campos obrigatórios
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'=>'Título obrigatório',
            'categoria_id.required'=>'Escolha uma categoria',
            'content.required'=>'Conteúdo do post obrigatório',
        ];
    }
}
