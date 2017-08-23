<?php
class Database{

    //databse credentials
    private $host = "localhost";
    private $db_name = "estoreapi_db";
    private $username = "root";
    private $password = "admin";
    private $conn;

    //get a connection to the database
    public function getConnection(){
      $this->conn = null;

      try{
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      }catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
      }

      return $this->conn;
    }

}

?>
