<?php

namespace CoreBundle\Processor\Factory;

use CoreBundle\Processor\UserSetupProcessor;
use Interop\Container\ContainerInterface;
use Towersystems\User\Processor\UserProcessorInterface;

class UserSetupProcessorFactory {

	public function __invoke(ContainerInterface $container): UserProcessorInterface{

		$userSetupProcessConfig = $container->get("config")["towersystems_process"]["user_setup"];
		$userSetupProcessor = new UserSetupProcessor();

		foreach ($userSetupProcessConfig as $processServiceName => $priority) {
			$userSetupProcessor->addProcessor($container->get($processServiceName), $priority);
		}

		return $userSetupProcessor;
	}
}
