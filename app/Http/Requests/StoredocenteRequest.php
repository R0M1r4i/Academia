<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredocenteRequest extends FormRequest
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
            'dni_docente' => 'required|unique:docente,dni_docente',
        ];
    }

    public function messages(): array
    {
        return [
            'dni_docente.unique' => 'El DNI ingresado ya existe en la base de datos. Por favor, ingrese uno diferente.',
        ];
    }
}
