<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackAuth(Request $request)
    {
        $provider = $request->input('provider', '');

        if (!in_array($provider, ['facebook', 'github'])) {
            return response()->json(['error' => 'Proveedor no válido'], 400);
        }

        $socialUser = Socialite::driver($provider)->user();

        $user = $this->findOrCreateUser($socialUser, $provider);
        $this->updateOrCreateProfile($user, $socialUser, $provider);

        Auth::login($user);

        return redirect()->to('/dashboard');
        // dd($socialUser);
    }

    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')->user();

        $user = $this->findOrCreateUser($socialUser, 'google');
        $this->updateOrCreateProfile($user, $socialUser, 'google');

        Auth::login($user);

        return redirect()->to('/dashboard');
        // dd($socialUser);
    }

    protected function findOrCreateUser($socialUser, $provider)
    {
        // Verificar si ya existe una cuenta social asociada con este proveedor y su provider_id
        $account = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($account) {
            // Si existe la cuenta social, devolver el usuario asociado
            return $account->user;
        }

        // No buscar por correo electrónico, siempre crear un nuevo usuario
        $userData = [
            'email' => $socialUser->getEmail(),
        ];

        switch ($provider) {
            case 'facebook':
                $nombreCompleto = $socialUser->getName();
                $partesNombre = explode(' ', $nombreCompleto);

                // Verificar cuántas partes tiene el nombre
                if (count($partesNombre) == 1) {
                    // Si solo hay una palabra, esa es el firstname, y lastname queda vacío
                    $userData['firstname'] = $partesNombre[0];
                    $userData['lastname'] = '';
                } elseif (count($partesNombre) == 2) {
                    // Si hay dos palabras, la primera es firstname, la segunda es lastname
                    $userData['firstname'] = $partesNombre[0];
                    $userData['lastname'] = $partesNombre[1];
                } else {
                    // Si hay más de dos palabras, las primeras dos van al firstname, el resto al lastname
                    $userData['firstname'] = $partesNombre[0] . ' ' . $partesNombre[1];
                    $userData['lastname'] = implode(' ', array_slice($partesNombre, 2));
                }

                break;
            case 'google':
                $userData['firstname'] = $socialUser->user['given_name'];
                $userData['lastname'] = $socialUser->user['family_name'];
                break;
            case 'github':
                // $userData['firstname'] = $socialUser->getName();
                $userData['firstname'] = $socialUser->getName() ?: $socialUser->getNickname();
                $userData['lastname'] = ''; // GitHub no proporciona apellido por defecto
                break;
        }

        // Crear un nuevo usuario
        $user = User::create($userData);

        // Crear una nueva cuenta social para vincularla al nuevo usuario
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ]);

        return $user;
    }

    protected function updateOrCreateProfile($user, $socialUser, $provider)
    {
        $avatarUrl = null;

        switch ($provider) {
            case 'facebook':
                // Para Facebook, necesitamos usar el token de acceso para obtener la imagen de perfil
                $token = $socialUser->token;
                $avatarUrl = "https://graph.facebook.com/v12.0/{$socialUser->getId()}/picture?type=large&access_token={$token}";
                break;
            case 'google':
                $avatarUrl = $socialUser->user['picture'];
                break;
            case 'github':
                $avatarUrl = $socialUser->getAvatar();
                break;
            default:
                // Si no es ninguno de los anteriores, usamos el método getAvatar() por defecto
                $avatarUrl = $socialUser->getAvatar();
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            ['avatar' => $avatarUrl]
        );
    }
}
