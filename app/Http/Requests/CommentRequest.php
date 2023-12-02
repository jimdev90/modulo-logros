<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'model_id' => 'required',
            'parent_id' => 'nullable',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'model_id.required' => 'Los datos del formulario no son correctos.',
            'content.required' => 'Este campo es obligatorio.',
        ];
    }
}
