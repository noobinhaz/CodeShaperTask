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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'model' => App\Models\Payment::class,
        'key' => env('STRIPE_KEY', 'sk_test_51MaM89JjHPdhxyimlGXZCxKXz7roJYPkxZCEOUoU8FpnVbBGbPsniexttKIKiLFG4o7vY3DZd7CS4WvFcjOLqe9P003jMSlCgX'),
        'secret' => env('STRIPE_SECRET', 'pk_test_51MaM89JjHPdhxyimx0t14x4TeFcnLUM2azwfYoFhHQGjcikTzcpBtrfmWmcaXaTsYsymkZzNVS4Ppx1fRJm4FLUh00jRO1ne9T'),
    ],

];