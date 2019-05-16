<?php

use Towersystems\Core\Model\User;

return [
	'doctrine' => [
		'driver' => [
			'orm_default' => [
				'drivers' => [
					User::class => 'core_bundle_config',
				],
			],
			'core_bundle_config' => [
				'class' => \Doctrine\ORM\Mapping\Driver\XmlDriver::class,
				'paths' => __DIR__ . '/../doctrine',
			],
		],
	],
];