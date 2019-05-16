<?php

namespace CoreBundle\Authentication;

use CoreBundle\Gateway\TowerAuthGatewayInterface;
use CoreBundle\Generator\JwtGeneratorInterface;
use League\Tactician\CommandBus;
use ResourceBundle\Repository\EntityRepository;
use Towersystems\Core\Command\SetupUserDatabase;
use Towersystems\Core\Exception\UserAlreadyExistsException;
use Towersystems\Core\Exception\UsernameNotFoundException;
use Towersystems\Resource\Factory\FactoryInterface;
use Towersystems\Talink\Exception\InvalidTokenException;

class UserAuthenticator implements UserAuthenticatorInterface {

	/** @var [type] [description] */
	protected $gateway;

	/** @var [type] [description] */
	protected $jwtGenerator;

	/** @var [type] [description] */
	protected $userRepository;

	/** @var [type] [description] */
	protected $userFactory;

	/** @var [type] [description] */
	protected $commandBus;

	/** @var [type] [description] */
	protected $options;

	/** @var [type] [description] */
	protected $entityManager;

	public function __construct(
		TowerAuthGatewayInterface $gateway,
		JwtGeneratorInterface $jwtGenerator,
		EntityRepository $userRepository,
		FactoryInterface $userFactory,
		array $options = [],
		CommandBus $commandBus,
		$entityManager
	) {
		$this->gateway = $gateway;
		$this->jwtGenerator = $jwtGenerator;
		$this->userRepository = $userRepository;
		$this->userFactory = $userFactory;
		$this->options = $options;
		$this->commandBus = $commandBus;
		$this->entityManager = $entityManager;
	}

	/**
	 * {@inheritdoc}
	 */
	public function authenticateUser($username, $password) {

		$token = $this->login($username, $password);
		$this->checkSubscription($token);

		$user = $this->getUser($username);
		$user->setToken($token);

		if (null == $user->getId()) {
			$this->userRepository->add($user);
		}

		$jwt = $this->generateJwt($user, $token);
		$user->setLastJWTToken($jwt);
		$user->setLastLoginAt(new \DateTime());

		$this->entityManager->flush();

		return $jwt;
	}

	public function setupUserByToken($token) {

		$this->checkToken($token);
		$this->checkSubscription($token);

		$username = strtolower($this->gateway->getUserBusinessDetails($token)['UName']);

		if (!$username) {
			throw new UsernameNotFoundException();
		}

		$user = $this->findUser($username);

		if ($user) {
			throw new UserAlreadyExistsException();
		}

		$user = $this->createUser($username);
		$jwt = $this->generateJwt($user, $token);

		$user->setLastJWTToken($jwt);
		$user->setToken($token);
		$user->setLastLoginAt(new \DateTime());
		$this->entityManager->flush();

		$command = new SetupUserDatabase($user, $jwt);
		$this->commandBus->handle($command);

		return true;
	}

	private function login($username, $password) {

		$token = $this->gateway->login($username, $password);

		// check if the login is correct
		if ('Incorrect username and or password.' === $token) {
			throw new InvalidTokenException();
		}

		return $token;
	}

	private function checkSubscription($token) {

		// check if the subscription is valid
		$isSubscribed = $this->gateway->isSubscribed($token);

		if (false == $isSubscribed) {
			throw new InvalidTokenException();
		}
	}

	private function checkToken($token) {

		$tokenValid = $this->gateway->checkToken($token);
		// check if the login is correct
		if (false === $tokenValid) {
			throw new InvalidTokenException();
		}
	}

	private function getUser($username) {

		$user = $this->findUser($username);

		if (!$user) {
			$user = $this->createUser($username);
		}

		return $user;
	}

	private function findUser($username) {
		return $this->userRepository->findOneBy(['username' => $username]);
	}

	private function createUser($username) {
		$user = $this->userFactory->createNew();
		$user->setUsername($username);
		$user->setDbName(sprintf($this->options['database_name_format'], $username));
		$user->setDbUsername($this->options['global_database_username']);
		$user->setDbPassword($this->options['global_database_password']);
		$this->userRepository->add($user);
		return $user;
	}

	private function generateJwt($user, $token) {
		$payload = array_merge($user->getPayload(), [
			'talink_auth_token' => $token,
		]);

		$expiry = new \DateTime('+ 7 day');

		return $this->jwtGenerator
			->setPayload($payload)
			->setExpiry($expiry)
			->generate();
	}

}
