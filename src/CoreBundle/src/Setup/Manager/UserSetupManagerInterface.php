<?php

declare (strict_types = 1);

namespace CoreBundle\Setup\Manager;

use CoreBundle\Setup\SetupInterface;
use Towersystems\User\Model\UserInterface;

interface UserSetupManagerInterface extends SetupInterface {

	/**
	 * @param UserInterface $user
	 *
	 * @return Self
	 */
	public function setUser(UserInterface $user): Self;

	public function setupAll(): void;
}