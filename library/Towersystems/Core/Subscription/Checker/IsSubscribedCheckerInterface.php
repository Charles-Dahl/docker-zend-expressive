<?php

namespace Towersystems\Core\Subscription\Checker;

interface IsSubscribedCheckerInterface {

	/**
	 * [IsSubscribedFromContext description]
	 *
	 * @param [type] $context [description]
	 */
	public function isSubscribed($param = null): bool;
}