<?php
/**
 * ListGateway to connect and query the readinglist table from the user database
 * 
 * Features a variety of functions to query the readinglist table in different ways. This includes finding all users and the adding and removing records to the readinglist table
 * 
 * @author Jacob Clark w18003237
 */

class ListGateway extends Gateway  {

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findAll($user_id) {
        $sql = "SELECT DISTINCT paper_id FROM readinglist WHERE user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function add($user_id, $paper_id) {
        $sql = "INSERT into readinglist (user_id, paper_id) VALUES (:user_id, :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }
      
    public function remove($user_id, $paper_id) {
        $sql = "DELETE from readinglist where (user_id = :user_id) AND (paper_id = :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }
}