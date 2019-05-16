<?php

namespace Towersystems\Core\Handler;

use Towersystems\Core\Command\PopulateDatabase;

class PopulateDatabaseHandler {

    protected $gateway;

    public function __construct(
        $gateway
    ) {
        $this->gateway = $gateway;
    }

    public function __invoke(PopulateDatabase $populateDatabase) {
        $token = $populateDatabase->getJwt();
        $this->gateway->setToken($token);
        $this->gateway->setup();
    }
}
