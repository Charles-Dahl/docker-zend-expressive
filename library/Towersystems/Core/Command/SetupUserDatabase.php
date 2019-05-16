<?php

namespace Towersystems\Core\Command;

use Towersystems\Core\Model\UserInterface;

class SetupUserDatabase {

    /**
     * @var UserInterface
     */
    protected $user;

    protected $jwt;

    public function __construct(
        $user,
        $jwt
    ) {
        $this->user = $user;
        $this->jwt = $jwt;
    }

    /**
     * @return UserInterface
     */
    public function getUser() {
        return $this->user;
    }

    public function getJwt() {
        return $this->jwt;
    }
}
