<?php

namespace CoreBundle\Authentication\Options;

use Zend\Stdlib\AbstractOptions;

class RetailerJwtOptions extends AbstractOptions {

	/**
	 * @return string
	 */
	public function getSecret() {
		return $this->secret;
	}

	/**
	 * @param string $secret
	 *
	 * @return self
	 */
	public function setSecret($secret) {
		$this->secret = $secret;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAlgorithm() {
		return $this->algorithm;
	}

	/**
	 * @param string $algorithm
	 *
	 * @return self
	 */
	public function setAlgorithm($algorithm) {
		$this->algorithm = $algorithm;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getPayload() {
		return $this->payload;
	}

	/**
	 * @param array $payload
	 *
	 * @return self
	 */
	public function setPayload(array $payload) {
		$this->payload = $payload;

		return $this;
	}
}