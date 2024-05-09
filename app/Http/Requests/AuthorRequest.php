<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email'),
            ],
            'web' => 'nullable|string|max:100|url',
            'description' => 'required|string|max:250',
            'password' => [
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/'
            ],
            'rol' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede superar los 250 caracteres.',

            'surname.required' => 'El campo apellidos es obligatorio.',
            'surname.string' => 'El campo apellidos debe ser una cadena de texto.',
            'surname.max' => 'El campo apellidos no puede superar los 250 caracteres.',

            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.exists' => 'El email proporcionado no existe en nuestra base de datos.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.',

            'rol.required' => 'El campo rol es obligatorio.',

            'web.nullable' => 'El campo web debe ser una cadena de texto o nulo.',
            'web.string' => 'El campo web debe ser una cadena de texto.',
            'web.max' => 'El campo web no puede superar los 100 caracteres.',
            'web.url' => 'El campo web debe ser una URL válida.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description cannot exceed 250 characters.',

        ];
    }
}
