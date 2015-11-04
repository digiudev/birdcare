<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '533226373508262',
        'client_secret' => '7d82c720bd3777941025ed647d896af0',
        'redirect' => 'http://birdbeta.it/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'dnGPCDPcY7NgpdxY1KgVzOysK',
        'client_secret' => 'VQLrjPbmuSpXqaAG2mV2CFad9Npv2fsXcKwJM5zcRY1nEKdaEy',
        'redirect' => 'http://birdbeta.it/auth/twitter/callback',
    ],

    'google' => [
        'client_id' => '515252813145-ki6gjd0icolvgbhvtp5afkc188qsc53o.apps.googleusercontent.com',
        'client_secret' => '_Y7OaYhyTGTHyCXr_UaO06pM',
        'redirect' => 'http://birdbeta.it/auth/google/callback',
    ],
];
