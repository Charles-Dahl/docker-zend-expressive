<?php

use CoreBundle\Gateway\Factory\PoslinkApiGatewayFactory;
use CoreBundle\Gateway\Factory\PoslinkGatewayFactory;
use CoreBundle\Gateway\Factory\TowerAuthGatewayFactory;
use CoreBundle\Gateway\Factory\TowerSubscriptionsGatewayFactory;
use CoreBundle\Gateway\PoslinkApiGateway;
use CoreBundle\Gateway\PoslinkGateway;
use CoreBundle\Gateway\TowerAuthGateway;
use Towersystems\Subscription\Gateway\TowerSubscriptionsGateway;

return [
	'dependencies' => [
		'factories' => [
			PoslinkGateway::class => PoslinkGatewayFactory::class,
			PoslinkApiGateway::class => PoslinkApiGatewayFactory::class,
			TowerAuthGateway::class => TowerAuthGatewayFactory::class,
			TowerSubscriptionsGateway::class => TowerSubscriptionsGatewayFactory::class,
		],
		'aliases' => [
			'tower.gateway.auth' => TowerAuthGateway::class,
			'tower.gateway.poslink' => PoslinkGateway::class,
			'tower.gateway.poslink_api' => PoslinkApiGateway::class,
			'tower.gateway.tower_subscription' => TowerSubscriptionsGateway::class,
		],
	],
];