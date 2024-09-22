<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ConfirmAccountDeactivationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password_confirmation' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('La confirmación de contraseña no coincide con la contraseña del usuario.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password_confirmation.required' => 'La confirmación de contraseña es requerida',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag('confirmAccountDeactivationErrors');
    }
}
