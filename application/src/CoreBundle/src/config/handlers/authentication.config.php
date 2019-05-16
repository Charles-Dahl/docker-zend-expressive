<?php

namespace CoreBundle\Handler;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [

	ConfigAbstractFactory::class => [

		LoginHandler::class => [
			'tower.authentication.user_authenticator',
		],

		RefreshTokenHandler::class => [
			'tower.options.retailer_jwt',
			'tower.repository.user',
			'tower.generator.jwt',
			'tower.gateway.auth',
		],

		GeneratePermanentTokenHandler::class => [
			'tower.repository.user',
			'tower.generator.jwt',
			'doctrine.entity_manager.orm_default',

		],

	],
];