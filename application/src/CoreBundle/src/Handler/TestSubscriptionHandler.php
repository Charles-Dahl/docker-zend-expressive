<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Authentication\UserAuthenticatorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class TestSubscriptionHandler implements RequestHandlerInterface {

	/**
	 * [$gatewaySubscribedChecker description]
	 * @var [type]
	 */
	private $gatewaySubscribedChecker;

	/**
	 * [__construct description]
	 * @param UserAuthenticatorInterface $gatewaySubscribedChecker [description]
	 */
	public function __construct(
		$gatewaySubscribedChecker
	) {
		$this->gatewaySubscribedChecker = $gatewaySubscribedChecker;
	}

	/**
	 * [handle description]
	 * @param  ServerRequestInterface $request [description]
	 * @return [type]                          [description]
	 */
	public function handle(ServerRequestInterface $request): ResponseInterface{

		$username = $request->getAttribute("username");
		$result = $this->gatewaySubscribedChecker->isSubscribed($username);

		return new JsonResponse([
			'username' => $username,
			'subscribed' => $result,
		], 200);

	}
}
