<?php

return [
    'default' => [
        'host'     => env('DB_HOST', 'mysql'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', '123456'),
        'dbname'   => env('DB_DATABASE', 'wechat'),
        'port'     => '3306',
        'charset'  => 'utf8'
    ],
];