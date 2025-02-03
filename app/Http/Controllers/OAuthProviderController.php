<?php

namespace App\Http\Controllers;

use App\Enums\OAuthProviderEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthProviderController extends Controller
{
    public function redirectToProvider(OAuthProviderEnum $provider){
        return Socialite::driver($provider->value)->redirect();
    }

    public function handleProviderCallback(OAuthProviderEnum $provider){
        $socialite = Socialite::driver($provider->value)->user();

        $user = User::firstOrCreate([
            'email' => $socialite->getEmail(),
        ], [
            'name' => $socialite->getName()
        ]);

        $user->providers()->updateOrCreate([
            'provider' => $provider,
            'provider_id' => $socialite->getId(),
        ]);

        Auth::login($user);

        if(empty($user->business)){
            return redirect()->route('business.edit');
        }

        return redirect()->route('business.active_clients', $user->business);
    }
}
