<?php

namespace CoreBundle\Gateway;

trait TowerAuthGatewayAwareTrait {

	/**
	 * [$towerAuthGateway description]
	 * @var [type]
	 */
	protected $towerAuthGateway;

	/**
	 * [getTowerAuthGateway description]
	 * @return [type] [description]
	 */
	public function getTowerAuthGateway() {
		return $this->towerAuthGateway;
	}

}