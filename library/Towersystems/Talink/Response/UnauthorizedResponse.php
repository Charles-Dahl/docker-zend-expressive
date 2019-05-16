<?php

namespace Towersystems\Talink\Response;

use Zend\Diactoros\Response\JsonResponse;

class UnauthorizedResponse extends JsonResponse {

	public function __construct() {
		parent::__construct(['error' => true, 'code' => 401, 'message' => 'Unauthorized'], 401);
	}
}