<?php

namespace CoreBundle\Authentication\Factory;

use CoreBundle\Authentication\UserAuthenticator;
use Interop\Container\ContainerInterface;

class UserAuthenticatorFactory {

	/**
	 * {@inheritdoc}
	 */
	public function __invoke(ContainerInterface $container, $requestedName) {
		$gateway = $container->get('tower.gateway.auth');
		$jwtGenerator = $container->get('tower.generator.jwt');
		$userRepository = $container->get('tower.repository.user');
		$userFactory = $container->get('tower.factory.user');
		$options = $this->resolveOptions($container->get("config"));
		$commandBus = $container->get('CommandBus');

		return new UserAuthenticator(
			$gateway,
			$jwtGenerator,
			$userRepository,
			$userFactory,
			$options,
			$commandBus,
			$container->get('doctrine.entity_manager.orm_default')
		);

	}

	/**
	 * @param  array $config
	 * @return array
	 */
	private function resolveOptions(array $config) {
		if (!isset($config['user_config'])) {
			throw new \Exception("Could not resolve user configuration", 1);
		}

		return $config['user_config'];
	}

}
