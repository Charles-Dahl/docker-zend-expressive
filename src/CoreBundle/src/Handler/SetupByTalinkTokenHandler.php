<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Authentication\UserAuthenticatorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Towersystems\Core\Exception\SetupUserDatabaseException;
use Towersystems\Core\Exception\UserAlreadyExistsException;
use Towersystems\Core\Exception\UsernameNotFoundException;
use Zend\Diactoros\Response\JsonResponse;

class SetupByTalinkTokenHandler implements RequestHandlerInterface {

	/**
	 * @var UserAuthenticatorInterface
	 */
	private $userAuthenticator;

	public function __construct(
		UserAuthenticatorInterface $userAuthenticator
	) {
		$this->userAuthenticator = $userAuthenticator;
	}

	public function handle(ServerRequestInterface $request): ResponseInterface{
		$token = $request->getParsedBody()['token'];

		try {
			$this->userAuthenticator->setupUserByToken($token);
		} catch (UserAlreadyExistsException $alreadyExistsException) {
			return new JsonResponse([
				'result' => 'Failure',
				'message' => 'Cannot create user, user already exists.',
			], 400);
		} catch (UsernameNotFoundException $notFoundException) {
			return new JsonResponse([
				'result' => 'Failure',
				'message' => 'Could not find user.',
			], 404);
		} catch (SetupUserDatabaseException $setupException) {
			return new JsonResponse([
				'result' => 'Failure',
				'message' => $setupException->getMessage(),
			], 500);
		}

		return new JsonResponse([
			'result' => 'Success',
		], 200);

	}
}
