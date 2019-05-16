<?php

namespace Towersystems\Subscription\Gateway;

use Zend\Http\Client;
use Zend\Http\Request;

/**
 *
 */
class TowerSubscriptionsGateway implements TowerSubscriptionsGatewayInterface {

	/** @var [type] [description] */
	private $options = [
		'environment' => 'subs.towersystems',
		'ssl' => false,
		'version' => 'api',
	];

	/** @var [type] [description] */
	protected $client;

	/**
	 * [__construct description]
	 *
	 * @param array  $options [description]
	 * @param Client $client  [description]
	 */
	public function __construct(
		array $options,
		Client $client
	) {
		$this->options = array_merge($this->options, $options);
		$this->client = $client;
	}

	/**
	 * [hasSubscription description]
	 *
	 * @param  string  $username [description]
	 * @param  string  $planCode [description]
	 * @return boolean           [description]
	 */
	public function hasSubscription(string $username, string $planCode): bool{

		$request = new Request();
		$request->setMethod(Request::METHOD_GET);

		$request->getHeaders()->addHeaders([
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		]);

		$request->setUri($this->getEndPoint(sprintf('site-users-by-username/%s/has-active-subscription/%s', $username, $planCode)));

		try {
			return $this->sendRequest($request)['result'];
		} catch (\Exception $e) {
			return false;
		}

	}

	/**
	 * [sendRequest description]
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	private function sendRequest(Request $request): array{
		$response = $this->client->send($request);

		if ($response->isSuccess()) {
			return json_decode($response->getBody(), true);
		}

		throw new \Exception("Error Processing Request", 1);
	}

	/**
	 * [getApiEndpoint description]
	 *
	 * @param  [type] $endpoint [description]
	 * @return [type]           [description]
	 */
	private function getEndPoint(string $endpoint): string{

		$version = $this->options['version'];
		$environment = $this->options['environment'];
		$ssl = $this->options['ssl'];

		return sprintf('http%s://%s/api/%s', $ssl ? 's' : '', $environment, $endpoint);
	}

}