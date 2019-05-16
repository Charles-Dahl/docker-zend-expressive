<?php

namespace CoreBundle\Setup;

use CoreBundle\Gateway\PoslinkApiGateway;
use CoreBundle\Gateway\PoslinkGateway;
use Towersystems\Core\Handler\CreateDatabaseHandler;
use Towersystems\Core\Handler\PopulateDatabaseHandler;
use Towersystems\Core\Handler\SetupDatabaseHandler;
use Towersystems\Core\Handler\SetupUserDatabaseHandler;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
    ConfigAbstractFactory::class => [
        Manager\UserSetupManager::class => [
            'doctrine.entity_manager.orm_default',
            'tower.processor.user_setup',
            'tower.repository.user',
        ],
        CreateDatabaseHandler::class => [
            PoslinkGateway::class,
        ],
        PopulateDatabaseHandler::class => [
            PoslinkApiGateway::class,
        ],
        SetupDatabaseHandler::class => [
            'CommandBus',
        ],
        SetupUserDatabaseHandler::class => [
            'CommandBus',
            'doctrine.entity_manager.orm_default',
        ],
    ],
    'dependencies' => [
        'aliases' => [
            'tower.manager.user_setup' => Manager\UserSetupManager::class,
        ],
    ],
];
