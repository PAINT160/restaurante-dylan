<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $request->authenticate();

            return redirect()->intended('dashboard')
                ->with('success', $request->messages()['login_success']);
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors(), 'userLoginErrors')
                ->withInput()
                ->with('openModal', 'login-modal');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['userLoginErrors' => $request->messages()['login_error']])
                ->withInput()
                ->with('openModal', 'login-modal');
        }
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
