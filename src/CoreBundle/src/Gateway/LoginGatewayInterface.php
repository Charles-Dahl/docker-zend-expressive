<?php

namespace CoreBundle\Gateway;

interface LoginGatewayInterface {

	/**
	 * @param  string $username
	 * @param  string $password
	 * @return string
	 */
	public function login(string $username, string $password): string;
}