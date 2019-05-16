<?php

declare (strict_types = 1);

namespace CoreBundle\Handler;

use CoreBundle\Setup\Manager\UserSetupManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;

class UserSetupHandler implements RequestHandlerInterface {

	/**
	 * @var UserSetupManagerInterface
	 */
	private $userSetupManager;

	public function __construct(
		UserSetupManagerInterface $userSetupManager
	) {
		$this->userSetupManager = $userSetupManager;
	}

	public function handle(ServerRequestInterface $request): ResponseInterface{

		$this->userSetupManager->setupAll();

		return new EmptyResponse();
	}
}