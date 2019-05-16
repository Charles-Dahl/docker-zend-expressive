<?php

use Towersystems\Talink\Middleware\InvalidTokenMiddleware;

return [
	'dependencies' => [
		'invokables' => [
			InvalidTokenMiddleware::class,
		],
	],
];