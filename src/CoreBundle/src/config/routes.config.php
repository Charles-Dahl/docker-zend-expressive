<?php

namespace CoreBundle;

return [
    'routes' => [
        'authentication.login' => [
            'path' => '/authentication/login',
            'middleware' => Handler\LoginHandler::class,
            'allowed_methods' => ['POST'],
        ],
        'setup' => [
            'path' => '/setup',
            'middleware' => Handler\UserSetupHandler::class,
            'allowed_methods' => ['GET'],
        ],
        'setup.with_token' => [
            'path' => '/setup/with-token',
            'middleware' => Handler\SetupByTalinkTokenHandler::class,
            'allowed_methods' => ['POST'],
        ],
        'setup.status' => [
            'path' => '/setup/status/{id}',
            'middleware' => 'tower.controller.user',
            'allowed_methods' => ['GET'],
            'options' => [
                'action' => 'checkStatus',
            ],
        ],
        'authentication.refresh_token' => [
            'path' => '/authentication/refresh-token',
            'middleware' => Handler\RefreshTokenHandler::class,
            'allowed_methods' => ['POST', 'GET'],
        ],

        'authentication.generate_permanent_token' => [
            'path' => '/authentication/generate-permanent-token',
            'middleware' => Handler\GeneratePermanentTokenHandler::class,
            'allowed_methods' => ['POST', 'GET'],
        ],

        'test.subscription' => [
            'path' => '/test/subscription/is-subscribed/{username}',
            'middleware' => Handler\TestSubscriptionHandler::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
