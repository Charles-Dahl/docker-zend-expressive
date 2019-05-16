<?php

namespace CoreBundle\Gateway;

/**
 *  Provide a gateway to external tower auth server
 */
interface TowerAuthGatewayInterface extends LoginGatewayInterface {

	const DEFAULT_GATEWAY_URL = 'http://orgsite.towersystems.com.au/wsdl/auth.php?wsdl';

	/**
	 * @param  string $token
	 * @return array
	 */
	public function getUserBusinessDetails(string $token): array;

	/**
	 * @param  string $token
	 * @return array
	 */
	public function getUserLocations(string $token): array;

	/**
	 * @param  string $token
	 * @return array
	 */
	public function getUserTerminals(string $token): array;

	/**
	 * @param  string $token
	 * @return bool
	 */
	public function checkToken(string $token): bool;

	/**
	 * [isSubscribed description]
	 * @param  string  $token [description]
	 * @return boolean        [description]
	 */
	public function isSubscribed(string $token): bool;
}