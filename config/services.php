<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '725620442443744',
        'client_secret' => '6090b1d0e43ff19aceb4ff6e9097691a',
        'redirect' => 'https://simranautomobiles.com/2023/share-ride/callback/facebook'
    ], 
    'google' => [
        'client_id' => '844234917176-dul42l3idlkmc4gsv8p9672qksi2d8k3.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://simranautomobiles.com/2023/share-ride/authorized/google/callback',
],

];
