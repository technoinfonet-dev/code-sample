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
    'linkedin' => [
        'client_id' => '81uwm6oq3tgfvi',
        'client_secret' => 'IsajUe7gLSUoVO0Y',
        'redirect' => 'https://www.example.com'
    ],  
    'facebook' => [
        'client_id' => '472233196760403',
        'client_secret' => '614bebc81145fdb4c0b77a3813b4e2f7',
        'redirect' => 'https://www.example.com'
    ], 
     'google' => [
        'client_id' => '291588829686-02lttken90nts7c6gfqossp77nc6ovc9.apps.googleusercontent.com',
        'client_secret' => 'X5082uMaZUyAbwrqXhnU1qtm',
        'redirect' => 'https://www.example.com'
    ]

];
