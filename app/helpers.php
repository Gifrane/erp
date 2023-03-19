<?php

function getUserIp()
{
    $keys = [
        'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'
    ];

    foreach ($keys as $k) {
        if (isset($_SERVER[ $k ])) {
            return $_SERVER[ $k ];
        }
    }

    return '';
}