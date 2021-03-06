<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->stateless()->user(), $social);
        auth()->login($user);
        return redirect()->to('/login/'.$social);
    }

    public function authorizeSocial(Request $request)
    {
         $user = SocialAccountService::login($request);
         auth()->login($user);
         return $user;
    }

    public function checkUser()
    {
        dd(auth()->user());
    }
}
