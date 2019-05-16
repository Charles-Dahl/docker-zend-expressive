<?php

namespace CoreBundle\Handler;

use CoreBundle\Handler\TestSubscriptionHandler;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [

    ConfigAbstractFactory::class => [

        UserSetupHandler::class => [
            'tower.manager.user_setup',
        ],

        SetupByTalinkTokenHandler::class => [
			'tower.authentication.user_authenticator',
        ],

        TestSubscriptionHandler::class => [
            'tower.checker.user_subscription',
        ],

    ],
];
