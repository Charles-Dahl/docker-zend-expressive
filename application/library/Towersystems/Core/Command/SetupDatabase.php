<?php

namespace Towersystems\Core\Command;

class SetupDatabase {

    /**
     * @var string
     */
    protected $name;

    protected $jwt;

    public function __construct(
        $name,
        $jwt
    ) {
        $this->name = $name;
        $this->jwt = $jwt;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    public function getJwt() {
        return $this->jwt;
    }
}
