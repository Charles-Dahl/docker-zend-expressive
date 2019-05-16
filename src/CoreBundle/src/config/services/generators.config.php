<?php

namespace CoreBundle\Generator;

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		JwtGenerator::class => [
			'tower.options.retailer_jwt',
		],
	],
	'dependencies' => [
		'aliases' => [
			'tower.generator.jwt' => JwtGenerator::class,
		],
	],
];