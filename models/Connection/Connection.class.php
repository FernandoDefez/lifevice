<?php

require('../../config/configDB.php');

class Connection
{
    private $host;
    private $user;
    private $db;
    private $pass;

    public function __construct()
    {
        $this->host = CONF_DB_HOST;
        $this->user = CONF_DB_USER;
        $this->db = CONF_DB_NAME;
        $this->pass = CONF_DB_PASS;
    }

    public function getConnection(){
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET NAMES UTF8");
            echo "Connected successfully<br>";
            return $conn;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

}

?>