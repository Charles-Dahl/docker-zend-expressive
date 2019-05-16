<?php

namespace Towersystems\Core\Command;

class PopulateDatabase {

    protected $jwt;

    public function __construct(
        $jwt
    ) {
        $this->jwt = $jwt;
    }

    public function getJwt() {
        return $this->jwt;
    }
}
