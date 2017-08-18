<?php
class Database{

    //databse credentials
    private $host = "";
    private $db_name = "";
    private $username = "";
    private $password = "";
    private $conn;

    //get a connection to the database
    public function getConnection(){
      $this->conn = null;

      try{
        $this->conn = new PDO("myql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      }catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
      }

      return $this->conn;
    }

}

?>
