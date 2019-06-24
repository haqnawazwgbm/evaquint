<?php

namespace App;

use App\User;
use App\SocialAccount;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);


          //  $user = User::whereEmail($providerUser->getEmail())->first();


                $user = $this->createSocialUser([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'avatar' => $providerUser->getAvatar(),
                ]);

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }

    public function createSocialUser($user)
    {
        // Split first and last names
        $name = explode(" ", $user['name']);

        $user = User::create([
            'email' => $user['email'],
            'first_name' => $name[0],
            'last_name' => $name[1],
            'user_picture' =>  $user['avatar'],
        ]);

        return $user;
    }
}