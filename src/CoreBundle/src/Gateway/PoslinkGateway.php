<?php

namespace CoreBundle\Gateway;

use Zend\Http\Client;
use Zend\Http\Request;

class PoslinkGateway implements PoslinkGatewayInterface {

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * @var array
	 */
	protected $options;

	public function __construct(Client $client, array $options = []) {
		$this->client = $client;
		$this->options = $options;
	}

	public function createDatabase($databaseName) {

		$request = new Request();
		$request->setMethod(Request::METHOD_POST);

		$xml = $this->options['add_database_xml'];
		$webspaceId = $this->options['webspace_id'];
		$request->setUri($this->options['url']);
		$request->getHeaders()->addHeaders([
			'Content-Type' => 'text/xml',
			'KEY' => $this->options['secret_key'],
		]);
		$request->setContent(sprintf($xml, $webspaceId, $databaseName));

		$response = $this->client->send($request);

		if (!$response->isSuccess()) {
			throw new \Exception(sprintf("Could not create database. Reason: []%s", $response->getBody()), 1);
		}
	}

}