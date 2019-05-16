<?php

declare (strict_types = 1);

namespace CoreBundle\Processor;

use League\Tactician\CommandBus;
use Towersystems\Core\Command\CreateDatabase;
use Towersystems\User\Model\UserInterface;
use Towersystems\User\Processor\UserProcessorInterface;

final class UserDatabaseSetupProcessor implements UserProcessorInterface {

	/**
	 * @var CommandBus
	 */
	private $commandBus;

	public function __construct(
		CommandBus $commandBus
	) {
		$this->commandBus = $commandBus;
	}

	public function process(UserInterface $user) {

		$command = new CreateDatabase($user->getDBName());

		$this->commandBus->handle($command);
	}
}
