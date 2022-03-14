<?php


/**
 * error controller to handle errors thrown by the api
 *
 * 
 * @author Jacob Clark w18003237
*/

class ApiErrorController extends Controller {

    protected function processRequest() {

        $this->getResponse()->setMessage("Endpoint not found");
        $this->getResponse()->setStatusCode(404);

        
    }
}