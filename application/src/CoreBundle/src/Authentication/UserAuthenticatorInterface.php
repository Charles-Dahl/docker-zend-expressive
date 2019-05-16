<?php

namespace CoreBundle\Authentication;

interface UserAuthenticatorInterface {

    /**
     * @param  string $username
     * @param  string $password
     * @return string jwt
     */
    public function authenticateUser($username, $password);

    /**
     * @param  string $token talink token
     * @return string jwt
     */
    public function setupUserByToken($token);

}
