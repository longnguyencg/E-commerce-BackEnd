<?php


namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;
use App\User;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $providerUser->getEmail() ?? $providerUser->getNickname();
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();

            if (!$user) {

                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'password' => Hash::make($providerUser->getName()),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    public static function login($request, $social='google')
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($request->id)
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $request->email;
            $account = new SocialAccount([
                'provider_user_id' => $request->id,
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();

            if (!$user) {

                $user = User::create([
                    'email' => $email,
                    'name' => $request->name,
                    'password' => Hash::make($request->id),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
