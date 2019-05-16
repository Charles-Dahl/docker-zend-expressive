<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

/** @var ClassLoader $loader */

$loader = require __DIR__ . '/../../vendor/autoload.php';
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return [
	'doctrine' => [
		'configuration' => [
			'orm_default' => [],
		],
		'driver' => [
			'orm_default' => [
				'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
			],
		],
		'connection' => [
			'orm_default' => [
				'params' => [
					'url' => 'mysql://super:super@database/test',
				],
			],
		],
	],
];
