<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:5'],
            'email' =>['required', 'email'],
            'password' => ['required', 'min:8'],
            'userName' => ['required', 'min:4'],
            'lastName' => ['required', 'min:5'],
            'birthDate' => ['required', 'date'],

        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser valido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'userName.required' => 'El nombre de usuario es requerido',
            'userName.min' => 'El nombre de usuario debe tener al menos 4 caracteres',
            'lastName.required' => 'El apellido es requerido',
            'lastName.min' => 'El apellido debe tener al menos 5 caracteres',
            'birthDate.required' => 'La fecha de nacimiento es requerida',
            'birthDate.date' => 'La fecha de nacimiento debe ser valida',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
