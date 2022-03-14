<?php

/**
 * Base Gateway class 
 * 
 * includes various functions used in the other gateway classes to query data from a datbase and return it.
 * 
 * @author Jacob Clark
 */

abstract class Gateway {

    private $database;
    private $result;

    protected function setDatabase($database) {
        $this->database = new Database($database);
    }

    protected function getDatabase() {
        return $this->database;
    }

    protected function setResult($result) {
        $this->result = $result;
    }

    public function getResult() {
        return $this->result;
    }
}