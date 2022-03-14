<?php
/**
 * Request class
 * 
 * Used to deal with requests within the api
 * 
 * Features a construction method to build up the requests
 * 
 * Along with individual methods to get parameters, paths and specified request methods
 * 
 * @author Jacob Clark
 */

class Request {
  
    private $basepath =  BASEPATH;
    private $path;
    private $requestMethod;
  
    public function __construct() {
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = strtolower(str_replace($this->basepath, "", $this->path));
        $this->path = trim($this->path,"/");
        // Get the request method
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
    }


    public function getPath() {
        return $this->path;
    }

    public function getRequestMethod() {
        return $this->requestMethod;
    } 

    public function getParameter($param) {
        if ($this->getRequestMethod() === "GET") {
            $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->getRequestMethod() === "POST") {
            $param = filter_input(INPUT_POST, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $param;
    }
}