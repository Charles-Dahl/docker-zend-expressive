<?php

namespace CoreBundle\Gateway;

use Zend\Http\Client;
use Zend\Http\Request;

class PoslinkApiGateway implements PoslinkApiGatewayInterface {

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * @var array
	 */
	protected $options;

	/**
	 * @var string
	 */
	protected $token;

	public function __construct(Client $client, array $options = []) {
		$this->client = $client;
		$this->options = $options;
	}

	/**
	 * @param string $token
	 */
	public function setToken(string $token): PoslinkApiGatewayInterface{
		$this->token = $token;
		return $this;
	}

	public function setup() {
		$request = new Request();
		$request->setUri(sprintf('%ssetup', $this->options['url']));
		$this->addAuthorizationHeader($request);

		$response = $this->client->send($request);

		if (!$response->isSuccess()) {
			throw new \Exception(sprintf("Error Connecting to Gateway. Reason[%s]", $response->getBody()), 1);
		}

	}

	private function addAuthorizationHeader(Request $request) {
		$request->getHeaders()->addHeaders([
			'Authorization' => sprintf('Bearer %s', $this->token),
		]);
	}
}