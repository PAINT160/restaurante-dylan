<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->withTrashed()->first();
                    if ($user && $user->deleted_at) {
                        return $fail('El correo electrónico ya está registrado, pero la cuenta está desactivada.');
                    } elseif ($user) {
                        return $fail('El correo electrónico ya está registrado.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'El campo de nombre es obligatorio.',
            'lastname.required' => 'El campo de apellido es obligatorio.',
            'dob.required' => 'El campo de fecha de nacimiento es obligatorio.',
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => '',
            'password_confirmation.required' => 'El campo de confirmación de contraseña es obligatorio',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'register_success' => 'Registro exitoso. Ahora puedes iniciar sesión.',
            'register_error' => 'Ocurrió un error al registrar la cuenta. Por favor, inténtalo de nuevo.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag('userRegisterErrors');
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (strlen($this->input('password')) >= 8 && strlen($this->input('password_confirmation')) >= 8 && $this->input('password') !== $this->input('password_confirmation')) {
                $validator->errors()->add('password', 'Las contraseñas no coinciden');
                $validator->errors()->add('password_confirmation', 'Las contraseñas no coinciden');
            }
        });
    }
}
