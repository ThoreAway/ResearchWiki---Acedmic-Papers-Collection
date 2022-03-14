<?php

/**
 * authentication controller to handle the login process and create json web tokens
 *
 * 
 * @author Jacob Clark w18003237
 */

use Firebase\JWT\JWT;

class ApiAuthenticateController extends Controller
{

    protected function setGateway()
    {
        $this->gateway = new UserGateway();
    }

    protected function processRequest()
    {
        $data = [];
        // Get the parameters
        $username = $this->getRequest()->getParameter("username");
        $password = $this->getRequest()->getParameter("password");
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($username) && !is_null($password)) {
                // Use the findPassword method in the UserGateway class to
                // find a password associated with the username address provided 
                $this->getGateway()->findPassword($username);

                // If there is a result then the username has matched a record
                // in the database and we can retrieve the hashed password for 
                // that user.
                if (count($this->getGateway()->getResult()) == 1) {
                    $hashpassword = $this->getGateway()->getResult()[0]['password'];
                    $userId = $this->getGateway()->getResult()[0]['id'];

                    // Verify if the passwords match
                    // If so, create a token
                    if (password_verify($password, $hashpassword)) {
                        $key = SECRET_KEY;

                        $payload = array(
                            "user_id" => $userId,
                            "username" => $username,
                            "exp" => time() + 3600,
                            "iat" => time(),
                            "iss" => $url
                        );

                        // Use the JWT class to encode the token
                        $jwt = JWT::encode($payload, $key, 'HS256');

                        $data = ['token' => $jwt];
                    }
                }
            }
            if (!array_key_exists('token', $data)) {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $data;
    }
}
