<?php 
  
/**
 * An abstract class that does not set any headers
 * 
 * Used for transfer of data between the classes 
 * 
 * Is returned from a request
 * 
 * @author Jacob Clark w18003237
 */

abstract class Response 
{
    protected $data;

    public function __construct() {
        $this->headers();
    }

    protected function headers() {
    }

    public function setData($data) {
        $this->data = $data;
    }    

    public function getData() {
        return $this->data;
    }
}