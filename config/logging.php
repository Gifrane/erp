<?php
return [
    'default' => 'stack',

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug')
        ],

        'user_error' => [
            'driver' => 'single',
            'path' => storage_path('logs/user_error.log'),
            'level' => 'debug',
        ],
    ],
];
