<?php

namespace Towersystems\Core\Handler;

use Doctrine\ORM\EntityManager;
use League\Tactician\CommandBus;
use Towersystems\Core\Command\SetupDatabase;
use Towersystems\Core\Command\SetupUserDatabase;
use Towersystems\Core\Exception\SetupUserDatabaseException;
use Towersystems\Core\Model\User;

class SetupUserDatabaseHandler {

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(
        CommandBus $commandBus,
        EntityManager $entityManager
    ) {
        $this->commandBus = $commandBus;
        $this->entityManager = $entityManager;
    }

    public function __invoke(SetupUserDatabase $setupUserDatabase) {
        $user = $setupUserDatabase->getUser();

        $setupState = $user->getSetupState();
        if (User::SETUP_STATE_COMPLETE !== $setupState) {
            if (User::SETUP_STATE_IN_PROGRESS === $setupState) {
                throw new SetupUserDatabaseException("User setup is already in progress");
            }

            $entityManager = $this->entityManager;
            $entityManager->getConnection()->beginTransaction();
            try {
                $user->setSetupState(User::SETUP_STATE_IN_PROGRESS);
                $entityManager->flush();

                $dbName = $user->getDbName();
                $jwt = $setupUserDatabase->getJwt();
                $command = new SetupDatabase($dbName, $jwt);
                $this->commandBus->handle($command);

                $user->setSetupState(User::SETUP_STATE_COMPLETE);
                $entityManager->flush();
                $entityManager->getConnection()->commit();
            } catch (\Exception $exception) {
                $entityManager->getConnection()->rollBack();
                $user->setSetupState(User::SETUP_STATE_FAILED);
                $entityManager->flush();
                throw new SetupUserDatabaseException("Unable to setup user: " . $exception->getMessage());
            }
        }
    }
}
