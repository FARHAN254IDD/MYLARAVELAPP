<?php

return [
    'env' => env('MPESA_ENV', 'sandbox'),

    'shortcode' => env('MPESA_SHORTCODE'),
    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
    'passkey' => env('MPESA_PASSKEY'),
    'callback' => env('MPESA_CALLBACK_URL'),

    'urls' => [
        'live' => 'https://api.safaricom.co.ke',
        'sandbox' => 'https://sandbox.safaricom.co.ke'
    ],
];
