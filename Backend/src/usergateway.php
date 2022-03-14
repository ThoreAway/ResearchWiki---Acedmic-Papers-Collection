<?php

/**
 * UserGateway connects to the user database
 * 
 * 
 * @author Jacob Clark
 */

class UserGateway extends Gateway  {

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    /**
     * Find password
     *
     * select a users id and password using their email
     *
     * @param string   $email      user email
     */

    public function findPassword($email) {
    $sql = " Select id, password from user where email = :email";
    $params = [":email" => $email];
    $result = $this->getDatabase()->executeSQL($sql, $params);
    $this->setResult($result);
    }

}