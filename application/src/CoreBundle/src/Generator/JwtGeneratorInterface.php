<?php

declare (strict_types = 1);

namespace CoreBundle\Generator;

interface JwtGeneratorInterface extends GeneratorInterface {

	/**
	 * @param array
	 *
	 * @return self
	 */
	public function setPayload(array $payload): Self;

	/**
	 * @param \DateTime $expiry
	 *
	 * @return self
	 */
	public function setExpiry(\DateTime $expiry): Self;
}