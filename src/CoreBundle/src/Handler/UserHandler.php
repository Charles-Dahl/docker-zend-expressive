<?php

namespace CoreBundle\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ResourceBundle\Handler\ResourceHandler;
use Zend\Diactoros\Response\JsonResponse;

class UserHandler extends ResourceHandler {

	/**
	 * @param  ServerRequestInterface $request
	 * @param  RequestHandlerInterface $handler
	 * @return ResponseInterface
	 */
	public function checkStatusAction(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface{

		$configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
		$user = $this->findOr404($configuration);

		return new JsonResponse($user->getSetupState());
	}

}