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

    'facebook' => [
        'client_id' => '390709151297548',
        'client_secret' => 'b14b1da5f6f6430879e3615fd1b7ef86',
        'redirect' => 'http://english.app/auth/facebook/callback',
    ],

    'github' => [
        'client_id' => '8635998a2f14b08b5086',
        'client_secret' => '655d425f97277c87b50f4a0b9ea90ebd27627815',
        'redirect' => 'http://english.app/auth/github/callback',
    ],

    'google' => [
        'client_id' => '491647004030-crkperqc0b3uvbvbmrhj7bmtqsthje4p.apps.googleusercontent.com',
        'client_secret' => 'cFrN2lPigABW5zsjDw-yy5wP',
        'redirect' => 'http://english.app/auth/google/callback',
    ],

];
