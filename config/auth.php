<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'useraccounts',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'useraccounts', 
        ],
    ],

    'providers' => [
        'useraccounts' => [
            'driver' => 'custom',
            'model' => App\Models\UserAccount::class,
        ],
    ],

    'passwords' => [
        'useraccounts' => [
            'provider' => 'useraccounts',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
