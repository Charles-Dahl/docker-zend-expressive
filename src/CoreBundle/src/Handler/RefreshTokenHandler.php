<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Authentication\Options\RetailerJwtOptions;
use CoreBundle\Gateway\TowerAuthGatewayInterface;
use CoreBundle\Generator\JwtGeneratorInterface;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ResourceBundle\Repository\EntityRepository;
use Towersystems\Talink\Exception\InvalidTokenException;
use Zend\Diactoros\Response\JsonResponse;

class RefreshTokenHandler implements RequestHandlerInterface {

	/**
	 * @var RetailerJwtOptions
	 */
	private $retailerJwtOptions;

	/**
	 * @var EntityRepository
	 */
	private $userRepository;

	/**
	 * @var JwtGeneratorInterface
	 */
	private $jwtGenerator;

	/**
	 * @var TowerAuthGatewayInterface
	 */
	private $gateway;

	public function __construct(
		RetailerJwtOptions $retailerJwtOptions,
		EntityRepository $userRepository,
		JwtGeneratorInterface $jwtGenerator,
		TowerAuthGatewayInterface $gateway
	) {
		$this->retailerJwtOptions = $retailerJwtOptions;
		$this->userRepository = $userRepository;
		$this->jwtGenerator = $jwtGenerator;
		$this->gateway = $gateway;
	}

	public function handle(ServerRequestInterface $request): ResponseInterface{
		$token = $request->getParsedBody()['token'];
		$retailerJwtOptions = $this->retailerJwtOptions;
		$decodedToken = JWT::decode($token, $retailerJwtOptions->getSecret(), [$retailerJwtOptions->getAlgorithm()]);

		$talinkToken = $decodedToken->talink_auth_token ?? null;

		if (!$this->gateway->checkToken($talinkToken) || !$this->gateway->isSubscribed($talinkToken)) {
			throw new InvalidTokenException();
		}

		$user = $this->userRepository->findOneBy(['id' => $decodedToken->user->id]);

		$payload = array_merge($user->getPayload(), [
			'talink_auth_token' => $talinkToken, // this will eventually crash
			'modules' => ['plugin.retailer'],
		]);

		$newToken = $this->jwtGenerator->setPayload($payload)->setExpiry(new \DateTime('+ 7 day'))->generate();
		return new JsonResponse(['token' => $newToken]);
	}
}
