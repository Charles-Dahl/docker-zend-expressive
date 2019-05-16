<?php

namespace Towersystems\Core\Handler;

use Towersystems\Core\Command\CreateDatabase;

class CreateDatabaseHandler {

    protected $gateway;

    public function __construct(
        $gateway
    ) {
        $this->gateway = $gateway;
    }

    public function __invoke(CreateDatabase $createDatabase) {
        $dbname = $createDatabase->getName();
        $this->gateway->createDatabase($dbname);
    }
}
