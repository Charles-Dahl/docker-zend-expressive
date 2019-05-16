<?php

use Towersystems\Core\Model\User;
use Towersystems\Core\Model\UserInterface;

return [
	'towersystems_resource' => [
		"resources" => [
			'tower.user' => [
				'classes' => [
					'model' => User::class,
					'interface' => UserInterface::class,
					'handler' => Handler\UserHandler::class,
				],
			],
		],
	],
];