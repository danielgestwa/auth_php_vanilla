<?php

class Connection {

    private $conn;

    public function __construct() {    
        try {
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=accounts', 'root', 'password');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $this->conn = $dbh;
    }

    public function getConn() {
        return $this->conn;
    }
}