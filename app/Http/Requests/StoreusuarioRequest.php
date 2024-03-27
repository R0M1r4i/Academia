<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreusuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario' => 'required|unique:usuario,usuario',

        ];
    }

    public function messages(): array
    {
        return [
            'usuario.unique' => 'El Usuario ingresado ya existe en la base de datos. Por favor, ingrese uno diferente.',
        ];
    }
}
