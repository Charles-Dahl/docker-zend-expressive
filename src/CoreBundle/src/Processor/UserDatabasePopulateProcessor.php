<?php

declare (strict_types = 1);

namespace CoreBundle\Processor;

use CoreBundle\Gateway\PoslinkApiGatewayInterface;
use Towersystems\User\Model\UserInterface;
use Towersystems\User\Processor\UserProcessorInterface;

final class UserDatabasePopulateProcessor implements UserProcessorInterface {

	/**
	 * @var PoslinkApiGatewayInterface
	 */
	private $gateway;

	public function __construct(
		PoslinkApiGatewayInterface $gateway
	) {
		$this->gateway = $gateway;
	}

	public function process(UserInterface $user) {
		$this->gateway->setToken($user->getLastJWTToken())->setup();
	}
}