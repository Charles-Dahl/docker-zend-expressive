<?php

declare (strict_types = 1);

namespace CoreBundle\Generator;

use CoreBundle\Authentication\Options\RetailerJwtOptions;
use Firebase\JWT\JWT;

class JwtGenerator implements JwtGeneratorInterface {

	/**
	 * @var RetailerJwtOptions
	 */
	protected $jwtOptions;

	/**
	 * @var array
	 */
	protected $payload = [];

	/**
	 * @var \DateTime
	 */
	protected $expiry;

	public function __construct(
		RetailerJwtOptions $jwtOptions
	) {
		$this->jwtOptions = $jwtOptions;
	}

	public function generate() {

		if (false === $this->canGenerateToken()) {
			throw new \Exception("Error Processing Request", 1);
		}

		$payload = array_merge($this->jwtOptions->getPayload(), $this->payload);

		$now = new \DateTime();
		$payload['iat'] = $now->getTimeStamp();

		if ($this->expiry) {
			$payload['exp'] = $this->expiry->getTimeStamp();
		}

		// $payload['exp'] = (new \DateTime('+ 20 second'))->getTimeStamp();

		return JWT::encode($payload, $this->jwtOptions->getSecret(), $this->jwtOptions->getAlgorithm());
	}

	/**
	 * {@inheritDoc}
	 */
	private function canGenerateToken(): bool {
		//todo: add logic
		return true;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setPayload(array $payload): JwtGeneratorInterface{
		$this->payload = $payload;

		return $this;
	}

	/**
	 * @param \DateTime $expiry
	 *
	 * @return self
	 */
	public function setExpiry(\DateTime $expiry): JwtGeneratorInterface{
		$this->expiry = $expiry;

		return $this;
	}
}