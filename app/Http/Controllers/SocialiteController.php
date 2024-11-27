<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')
            ->setScopes(['repo', 'read:user', 'user:email'])
            ->redirect();
    }

    public function callback(): RedirectResponse
    {
        $socialiteUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate(
            ['github_id' => $socialiteUser->getId()],
            [
                'name' => $socialiteUser->getName(),
                'username' => $socialiteUser->getNickname(),
                'email' => $socialiteUser->getEmail(),
                'github_token' => $socialiteUser->token,
                'github_avatar' => $socialiteUser->avatar,
                'github_url' => $socialiteUser->url,
            ]
        );

        Auth::login($user);

        return redirect()->route('startpage');
    }
}
