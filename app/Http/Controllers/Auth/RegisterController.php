<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = \App\Models\User::create($request->only([
                'firstname',
                'lastname',
                'dob',
                'email',
                'password',
            ]));
            $user->password = bcrypt($request->input('password'));
            $user->save();

            Auth::login($user);

            return redirect()->intended('dashboard')
                ->with('success', $request->messages()['register_success']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Depuración para verificar errores
            dd($e->errors());

            return back()
                ->withErrors($e->errors(), 'userRegisterErrors')
                ->withInput()
                ->with('openModal', 'register-modal');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['userRegisterErrors' => $request->messages()['register_error']])
                ->withInput()
                ->with('openModal', 'register-modal');
        }
    }
}
