<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'login_success' => 'Inicio de sesión exitoso.',
            'email_not_exists' => 'El correo electrónico no existe.',
            'incorrect_password' => 'La contraseña es incorrecta.',
            'login_error' => 'Ocurrió un error al iniciar sesión. Por favor, inténtalo de nuevo.',
        ];
    }

    protected function attemptLogin()
    {
        $credentials = $this->only('email', 'password');

        // Verifica si el usuario existe
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if (!$user) {
            // El correo electrónico no existe
            return false;
        }

        // Verifica las credenciales
        if (Auth::attempt($credentials)) {
            $this->session()->regenerate();
            return true;
        }

        // La contraseña es incorrecta
        return false;
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag('userLoginErrors');
    }

    public function authenticate()
    {
        $credentials = $this->only('email', 'password');

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => [$this->messages()['email_not_exists']],
            ]);
        }

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'password' => [$this->messages()['incorrect_password']],
            ]);
        }

        $this->session()->regenerate();
    }
}
