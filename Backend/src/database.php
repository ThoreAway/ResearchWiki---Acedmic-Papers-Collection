<?php
 
/**
 * Connect to an SQLite database 
 * 
 * Various defined function to set database connection and execute sql querys
 * 
 * @author Jacob Clark w18003237
 */
class Database 
{
    private $dbConnection;

    public function __construct($dbName) {
        $this->setDbConnection($dbName);
    }


    private function setDbConnection($dbName) {           
            $this->dbConnection = new PDO('sqlite:'.$dbName);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeSQL($sql, $params=[]) { 
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}