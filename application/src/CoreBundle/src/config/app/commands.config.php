<?php

return [
    "command_bus_mappings" => [
        \Towersystems\Core\Command\CreateDatabase::class => \Towersystems\Core\Handler\CreateDatabaseHandler::class,
        \Towersystems\Core\Command\PopulateDatabase::class => \Towersystems\Core\Handler\PopulateDatabaseHandler::class,
        \Towersystems\Core\Command\SetupDatabase::class => \Towersystems\Core\Handler\SetupDatabaseHandler::class,
        \Towersystems\Core\Command\SetupUserDatabase::class => \Towersystems\Core\Handler\SetupUserDatabaseHandler::class,
    ],
];
