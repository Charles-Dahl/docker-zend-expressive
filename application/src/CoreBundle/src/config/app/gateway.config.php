<?php

return [
	'tower_subscription_gateway' => [
		'options' => [
			'environment' => 'subs.towersystems.com',
		],
	],
	'poslink_gateway' => [
		'options' => [
			'url' => 'https://223.27.15.125:8443/enterprise/control/agent.php',
			'secret_key' => 'b04b02f4-a2f4-a1da-0aa8-d42693356fa7',
			'webspace_id' => '1',
			'add_database_xml' => '
				<?xml version="1.0" encoding="UTF-8" ?>
				<packet>
					<database>
						<add-db>
						   <webspace-id>%s</webspace-id>
						   <name>%s</name>
						   <type>mysql</type>
						</add-db>
					</database>
				</packet>
			',
		],
	],
	'poslink_api_gateway' => [
		'options' => [
			'url' => 'https://roam.towersystems.com.au/api/',
		],
	],
	'tower_auth_gateway' => [
		'options' => [
			'url' => 'http://orgsitelocal.towersystems.com.au/wsdl/roam.php?wsdl',
		],
	],
];