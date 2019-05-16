<?php

use Towersystems\Core\Subscription\Checker\GatewaySubscribedChecker;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		GatewaySubscribedChecker::class => [
			'tower.gateway.tower_subscription',
		],
	],
	'dependencies' => [
		'factories' => [],
		'aliases' => [
			'tower.checker.user_subscription' => GatewaySubscribedChecker::class,
		],
	],
];