<?php

namespace CoreBundle\Gateway;

use Zend\Soap\Client;

/**
 *  Gateway to communicate with the tower auth server
 *
 *  Add any other communication here
 */
class TowerAuthGateway implements TowerAuthGatewayInterface {

	/**
	 * Soap soapClient to talk to Auth Server
	 *
	 * @var Client
	 */
	private $soapClient;

	public function __construct(
		Client $soapClient
	) {
		$this->soapClient = $soapClient;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getUserBusinessDetails(string $token): array{
		return (array) $this->soapClient->getBusinessDetails($token);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getUserLocations(string $token): array{
		$businessDetails = $this->getUserBusinessDetails($token);
		return $businessDetails['Locations'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getUserTerminals(string $token): array{
		return (array) $this->soapClient->getUserDetails($token)->Terminals;
	}

	/**
	 * {@inheritdoc}
	 */
	public function login(string $username, string $password): string{
		$a = $this->soapClient->login($username, $password);
		return $a;
	}

	/**
	 * {@inheritdoc}
	 */
	public function checkToken(string $token): bool {
		return (bool) $this->soapClient->checkToken($token);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSubscribed(string $token): bool {
		return (bool) $this->soapClient->isSubscribed($token);
	}
}