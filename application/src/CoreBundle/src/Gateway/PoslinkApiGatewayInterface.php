<?php

namespace CoreBundle\Gateway;

interface PoslinkApiGatewayInterface {

	/**
	 * @param string $token
	 */
	public function setToken(string $token): PoslinkApiGatewayInterface;

	public function setup();
}