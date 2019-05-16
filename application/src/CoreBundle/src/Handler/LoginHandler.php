<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Authentication\UserAuthenticatorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class LoginHandler implements RequestHandlerInterface {

	/**
	 * [$userAuthenticator description]
	 * @var [type]
	 */
	private $userAuthenticator;

	/**
	 * [__construct description]
	 * @param UserAuthenticatorInterface $userAuthenticator [description]
	 */
	public function __construct(
		UserAuthenticatorInterface $userAuthenticator
	) {
		$this->userAuthenticator = $userAuthenticator;
	}

	/**
	 * [handle description]
	 * @param  ServerRequestInterface $request [description]
	 * @return [type]                          [description]
	 */
	public function handle(ServerRequestInterface $request): ResponseInterface{
		$credentials = json_decode($request->getBody()->getContents(), true);

		$authenticator = $this->userAuthenticator;
		$jwtToken = $authenticator->authenticateUser($credentials['username'], $credentials['password']);
		$authResponse = ['token' => $jwtToken];
		return new JsonResponse($authResponse, 200);
	}
}
