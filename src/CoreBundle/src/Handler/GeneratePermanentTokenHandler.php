<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Authentication\UserAuthenticatorInterface;
use CoreBundle\Generator\JwtGeneratorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ResourceBundle\Repository\EntityRepository;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\JsonResponse;

class GeneratePermanentTokenHandler implements RequestHandlerInterface {

	/**
	 * [$userRepository description]
	 * @var [type]
	 */
	protected $userRepository;

	/**
	 * [$jwtGenerator description]
	 * @var [type]
	 */
	protected $jwtGenerator;

	/**
	 * [$entityManager description]
	 * @var [type]
	 */
	protected $entityManager;

	/**
	 * [__construct description]
	 * @param UserAuthenticatorInterface $userAuthenticator [description]
	 */
	public function __construct(
		EntityRepository $userRepository,
		JwtGeneratorInterface $jwtGenerator,
		$entityManager
	) {
		$this->userRepository = $userRepository;
		$this->jwtGenerator = $jwtGenerator;
		$this->entityManager = $entityManager;
	}

	/**
	 * [handle description]
	 * @param  ServerRequestInterface $request [description]
	 * @return [type]                          [description]
	 */
	public function handle(ServerRequestInterface $request): ResponseInterface{

		$credentials = $request->getParsedBody();

		$user = $this->userRepository->findOneBy(["username" => $credentials['username']]);
		$token = $credentials['talink_token'] ?? null;

		if (false == $user || null === $token) {
			return new EmptyResponse(404);
		}

		// validate the token maybe ? ?
		$payload = $user->getPayload();

		$token = $this->jwtGenerator->setPayload(array_merge($payload, [
			'talink_auth_token' => $token,
		]))->generate();

		return new JsonResponse(['token' => $token]);

	}
}
