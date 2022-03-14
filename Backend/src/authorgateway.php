<?php

/**
 * AuthorGateway to connect and query the author table from the database
 * 
 * Features a variety of functions to query the author table in different ways. With a base sql query that all the functions can add 
 * aditionnal SQL to change what is queried
 * 
 * The functions include selecting all authors, selecting one author based on specifed ID and selecting all authors based on specified 
 * a paper id.
 * 
 * @author Jacob Clark w18003237
 */


class AuthorGateway extends Gateway  {

    private $sql = "SELECT author.author_id as AuthorId, first_name as FirstName, middle_name as MiddleName, last_name as LastName 
                    FROM author";

    public function __construct() {
        $this->setDatabase(DATABASE);
    }

    public function findAll()
    {
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findOne($id)
    {
        $this->sql .= " WHERE author_id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function findAllByPaper($paperid)
    {
        $this->sql .= " join paper_author on (paper_author.author_id = author.author_id)
                        join paper on (paper_author.paper_id = paper.paper_id)
                        where paper.paper_id = :id";
        $params = ["id" => $paperid];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}