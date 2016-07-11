<?php

return [
    'components' => [
        'connection' => [
            'class'     => '\Micro\Db\Connection',
            'arguments' => [
                'dsn' => 'pgsql:host=localhost;dbname=news',
                'config' => [
                    'username' => 'news',
                    'password' => 'news',
                    'schema' => 'public'
                ]
            ]
        ]
    ]
];
