<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlidesRequest extends FormRequest
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
            'status' => 'required',
            'title' => 'required',
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
            'title.required' => 'Título obrigatório',
            'status.required' => 'Status obrigatório',
        ];
    }
}
