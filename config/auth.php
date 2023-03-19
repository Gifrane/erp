<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users'
        ],

        'auth' => [
            'driver' => 'session',
            'provider' => 'auth',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false
        ]
    ],

    'providers' => [
        'auth' => [
            'driver' => 'auth',
        ],
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User\User::class
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60
        ]
    ],

    'password_timeout' => 10800
];
