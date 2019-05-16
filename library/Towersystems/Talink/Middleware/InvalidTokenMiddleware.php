<?php

namespace Towersystems\Talink\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Towersystems\Talink\Exception\InvalidTokenException;
use Towersystems\Talink\Response\UnauthorizedResponse;

class InvalidTokenMiddleware implements MiddlewareInterface {

	/**
	 * @param  ServerRequestInterface $request
	 * @param  RequestHandlerInterface $handler
	 * @return ResponseInterface
	 */
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {

		try {
			$response = $handler->handle($request);
		} catch (InvalidTokenException $exception) {
			$response = new UnauthorizedResponse();
		}

		return $response;
	}

}