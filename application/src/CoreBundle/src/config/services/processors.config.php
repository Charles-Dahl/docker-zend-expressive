<?php

namespace CoreBundle\Processor;

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		UserDatabaseSetupProcessor::class => [
			'CommandBus',
		],
		UserDatabasePopulateProcessor::class => [
			'tower.gateway.poslink_api',
		],
	],
	'dependencies' => [
		'factories' => [
			UserSetupProcessor::class => Factory\UserSetupProcessorFactory::class,
		],
		'aliases' => [
			'tower.processor.user_setup' => UserSetupProcessor::class,
			'tower.processor.user_database_setup' => UserDatabaseSetupProcessor::class,
			'tower.processor.user_database_populate' => UserDatabasePopulateProcessor::class,
		],
	],
];