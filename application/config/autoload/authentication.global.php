<?php

return [
	'retailer_jwt_options' => [
		"secret" => "supersecretkeyyoushouldnotcommittogithub",
		"algorithm" => 'HS256',
		"payload" => [
			// "iss" => null,
			// "sub" => null,
			// "aud" => null,
			// "exp" => null,
			// "nbf" => null,
			// "iat" => null,
			// "jti" => null,
		],
	],
];