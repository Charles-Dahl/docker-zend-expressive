<?php

namespace Towersystems\Subscription\Gateway;

/**
 *
 */
interface TowerSubscriptionsGatewayInterface {

	/**
	 * [hasSubscription description]
	 *
	 * @param  string  $username [description]
	 * @param  string  $planCode [description]
	 * @return boolean           [description]
	 */
	public function hasSubscription(string $username, string $planCode): bool;

}