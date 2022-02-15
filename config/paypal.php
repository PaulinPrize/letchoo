<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), 
    /*
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret'    =>env('PAYPAL_SANDBOX_CLIENT_SECRET',),
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],
    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), 
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), 
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), 
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), 
    */
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', ''),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', ''),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'APP-80W284485P519543T', 
    ],
    
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', 
    ],

    'payment_action' => 'Sale', 
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', 
    'locale'         => '', 
    'validate_ssl'   => true, 
    ];
?>