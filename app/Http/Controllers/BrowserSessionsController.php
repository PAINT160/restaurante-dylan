<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrowserSessionsController extends Controller
{
    public function destroy(Request $request)
    {
        // Valida la contraseña con un mensaje de error personalizado
        $request->validateWithBag('errorsSesion', [
            'password' => 'required|current_password',
        ], [
            'password.required' => 'La contraseña es requerida.',
            'password.current_password' => 'La contraseña proporcionada no es la contraseña actual.',
        ]);

        // Si hay errores, redirige de vuelta con errores
        if ($errors = session('errorsSesion')) {
            return redirect()->back()->withErrors($errors);
        }

        // Si la validación pasa, cierra sesión en otros dispositivos
        Auth::logoutOtherDevices($request->password);

        // Elimina registros de sesión
        $this->deleteOtherSessionRecords();

        // Agrega un mensaje de éxito a la sesión
        return redirect()->back()->with('success', 'Sesión eliminada en otros navegadores');
    }

    protected function deleteOtherSessionRecords()
    {
        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }
}
