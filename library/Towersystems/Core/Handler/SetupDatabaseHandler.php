<?php

namespace Towersystems\Core\Handler;

use League\Tactician\CommandBus;
use Towersystems\Core\Command\CreateDatabase;
use Towersystems\Core\Command\PopulateDatabase;
use Towersystems\Core\Command\SetupDatabase;

class SetupDatabaseHandler {

    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(
        CommandBus $commandBus
    ) {
        $this->commandBus = $commandBus;
    }

    public function __invoke(SetupDatabase $setupDatabase) {

        $createCommand = new CreateDatabase($setupDatabase->getName());
        $populateCommand = new PopulateDatabase($setupDatabase->getJwt());

        $this->commandBus->handle($createCommand);
        $this->commandBus->handle($populateCommand);
    }
}
