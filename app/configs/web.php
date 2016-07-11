<?php

return [
    'components' => [
        'response' => [
            'class' => '\Micro\Web\Response'
        ],
        'router' => [
            'class' => '\Micro\Web\Router',
            'arguments' => [
                'routes' => [
                    '/news/<slug:\w+>' => '/news/index',
                    '/admin/<controller:\w+>/<id:\d+>' => '/admin/<controller>/read',
                    '/admin/<controller:\w+>/<action:\w+>/<id:\d+>' => '/admin/<controller>/<action>'
                ]
            ]
        ],
        'auth' => [
            'class' => '\Micro\Auth\DbRbac',
            'arguments' => [
                'connection' => '@connection'
            ]
        ],
        'cookie' => [
            'class' => '\Micro\Web\Cookie',
            'arguments' => [
                'request' => '@request'
            ]
        ],
        'session' => [
            'class' => '\Micro\Web\Session',
            'arguments' => [
                'request' => '@request',
                'autoStart' => true
            ]
        ],
        'user' => [
            'class' => '\Micro\Web\User',
            'arguments' => [
                'session' => '@session'
            ]
        ],
        'flash' => [
            'class' => '\Micro\Web\FlashMessage',
            'arguments' => [
                'session' => '@session'
            ]
        ]
    ]
];
