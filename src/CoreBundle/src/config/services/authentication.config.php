<?php

namespace CoreBundle\Authentication;

use CoreBundle\Authentication\Factory\UserAuthenticatorFactory;

return [
	'dependencies' => [
		'factories' => [
			Options\RetailerJwtOptions::class => Options\Factory\RetailerJwtOptionsFactory::class,
			UserAuthenticator::class => UserAuthenticatorFactory::class,
		],
		'aliases' => [
			'tower.authentication.user_authenticator' => UserAuthenticator::class,
			'tower.options.retailer_jwt' => Options\RetailerJwtOptions::class,
		],
	],
];