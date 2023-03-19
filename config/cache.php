<?php
return [
    'default' => 'redis',

    'stores' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default'
        ]
    ],

    'prefix' => 'app_cache',
];
