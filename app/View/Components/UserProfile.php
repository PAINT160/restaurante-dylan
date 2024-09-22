<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UserProfile extends Component
{
    public ?User $user;
    public ?string $avatarUrl;

    public function __construct()
    {
        $this->user = Auth::user();

        if ($this->user instanceof User) {
            $lastProfile = Profile::where('user_id', $this->user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $this->avatarUrl = $lastProfile && $lastProfile->avatar
                ? $this->getAvatarUrl($lastProfile->avatar, $this->user)
                : null;
        } else {
            $this->avatarUrl = null;
        }
    }

    protected function getAvatarUrl(string $avatar, User $user): string
    {
        if (strpos($avatar, 'https://graph.facebook.com') === 0) {
            // Es una URL de Facebook, necesitamos regenerar el token
            $fbAccount = $user->socialAccounts()->where('provider', 'facebook')->first();
            if ($fbAccount && $fbAccount->token) {
                $userId = explode('/', parse_url($avatar, PHP_URL_PATH))[2] ?? null;
                if ($userId) {
                    return "https://graph.facebook.com/v12.0/{$userId}/picture?type=large&access_token={$fbAccount->token}";
                }
            }
        }
        return $avatar;
    }

    public function render()
    {
        return view('components.user-profile', [
            'user' => $this->user,
            'avatarUrl' => $this->avatarUrl,
        ]);
    }
}