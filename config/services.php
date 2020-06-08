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

    'google' => [
    'client_id' => '714792849198-qcdgl1hmom7v1gpb83tu9dpad0iagani.apps.googleusercontent.com',
    'client_secret' => 'YWeapR5VrfUoi8zC9iIPyb4l',
    'redirect' => 'http://localhost/lara_shop/callback/google',
    ], 

    'facebook' => [
    'client_id' => '703106813755692',
    'client_secret' => 'ea019abea64cf773f1f79b629bbad07b',
    'redirect' => 'http://localhost/lara_shop/callback/facebook',
    ], 

];
