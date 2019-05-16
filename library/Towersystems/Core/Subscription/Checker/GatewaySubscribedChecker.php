<?php

namespace Towersystems\Core\Subscription\Checker;

use Towersystems\Subscription\Gateway\TowerSubscriptionsGatewayInterface;

class GatewaySubscribedChecker implements IsSubscribedCheckerInterface {

	/** @var [type] [description] */
	protected $gateway;

	/** @var [type] [description] */
	protected $options = [
		'plan_code' => 'cloud_outpost',
	];

	/**
	 * [__construct description]
	 *
	 * @param TowerSubscriptionsGatewayInterface $gateway [description]
	 * @param array                              $options  [description]
	 */
	public function __construct(
		TowerSubscriptionsGatewayInterface $gateway,
		array $options = []
	) {
		$this->gateway = $gateway;
		$this->options = array_merge($this->options, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSubscribed($param = null): bool {
		return $this->gateway->hasSubscription($param, $this->options['plan_code']);
	}

}