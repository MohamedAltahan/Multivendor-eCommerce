<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //github ______________________________________________________________________
    public function githubLogin()
    {
        //to communicate with provider
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        $userData = Socialite::driver('github')->user();
        $userName = $userData->getName() ?? $userData->getNickname();
        $user = User::updateOrCreate([
            'provider_id' => $userData->getId()
        ], [
            'name' => $userName,
            'email' => $userData->getEmail(),
        ]);

        Auth::login($user, true);
        return redirect()->route('home');
    }

    //facebook________________________________________________________________________
    public function facebookLogin()
    {
        //to communicate with provider
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {

        $userData = Socialite::driver('facebook')->user();
        $userName = $userData->getName() ?? $userData->getNickname();
        $user = User::updateOrCreate([
            'provider_id' => $userData->getId()
        ], [
            'name' => $userName,
            'email' => $userData->getEmail(),
        ]);

        Auth::login($user, true);
        return redirect()->route('home');
    }

    //google ________________________________________________________________________
    public function googleLogin()
    {
        //to communicate with provider
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {

        $userData = Socialite::driver('google')->user();
        $userName = $userData->getName() ?? $userData->getNickname();
        $user = User::updateOrCreate([
            'provider_id' => $userData->getId()
        ], [
            'name' => $userName,
            'email' => $userData->getEmail(),
        ]);

        Auth::login($user, true);
        return redirect()->route('home');
    }
}
