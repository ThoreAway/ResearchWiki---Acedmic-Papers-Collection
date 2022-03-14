<?php

/**
 * PaperGateway to connect and query the paper table from the database
 * 
 * Features a variety of functions to query the paper table in different ways. With a base sql query that all the functions can add 
 * aditionnal SQL to change what is queried
 * 
 * The functions include selecting all papers, selecting one paper based on specifed ID, selecting one paper based on specified author id and selecting all papers where that have an award or all papers that dont
 * 
 * @author Jacob Clark w18003237
 */

class PaperGateway extends Gateway  {

   private $sql = "SELECT paper.paper_id as PaperId, title, abstract, 
                    group_concat (award_type.name , ', ') as award 
                    FROM paper
                    LEFT JOIN award on (paper.paper_id = award.paper_id)
                    LEFT JOIN award_type on (award.award_type_id = award_type.award_type_id)";

    public function __construct() {
        $this->setDatabase(DATABASE);
    }

    public function findAll()
    {
        $this->sql .= "GROUP BY paper.paper_id, paper.title
                       ORDER BY REPLACE(title, '\"','') ASC";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findOne($id)
    {
        $this->sql .= "WHERE paper.paper_id = :id
                       GROUP BY paper.paper_id, paper.title
                       ORDER BY REPLACE(title, '\"','') ASC";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    
    public function findAuthor($authorId)
    {
        $this->sql .= "LEFT JOIN paper_author on (paper.paper_id = paper_author.paper_id)
                     LEFT JOIN author on (paper_author.author_id = author.author_id)
                     WHERE author.author_id = :id
                     GROUP BY paper.paper_id, paper.title
                     ORDER BY REPLACE(title, '\"','') ASC";
        $params = ["id" => $authorId];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function findAwarded()
    {
        $this->sql .= "WHERE award_type.name IS NOT NULL
                       GROUP BY paper.paper_id, paper.title
                       ORDER BY REPLACE(title, '\"','') ASC";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findNotAwarded()
    {
        $this->sql .= "WHERE award_type.name IS NULL
                       GROUP BY paper.paper_id, paper.title
                       ORDER BY REPLACE(title, '\"','') ASC";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }


}


