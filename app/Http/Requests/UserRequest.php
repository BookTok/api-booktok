<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:250',
            'surname' => 'required|string|max:250',
            'password' => [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('user')->ignore($userId),
                ],
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/'
            ],
            'confirmPassword' => [
                'required_with:password',
                'same:password',
            ],
            'rol' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.',
            'confirmPassword.required_with' => 'El campo repetir contraseña es obligatorio cuando se proporciona una contraseña.',
            'confirmPassword.same' => 'La confirmación de la contraseña no coincide con la contraseña proporcionada.',
            'rol.required' => 'El rol es obligatorio'
        ];
    }
}
