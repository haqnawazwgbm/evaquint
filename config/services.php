<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1830221587222059',
        'client_secret' => '711624f1c48cb7a405af9e6fd8cffe8c',
        'redirect' => 'https://fleek.mindgigspk.com/callback/facebook',
    ],

    'twitter' => [
        'client_id' => 'LqyAB31JwOjl57i9xLdn58pzM',
        'client_secret' => '8Gz7dXD62lMiAIlYGGCTCpDcZZ5euF7Yoerfw0HdqXZ2D5Pi3q',
        'redirect' => 'https://fleek.mindgigspk.com/callback/twitter',
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
