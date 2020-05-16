<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "db_oop";
    private $username = "root";
    private $password = "*******";  //isi dengan password database anda
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
            die();
        }
  
        return $this->conn;
    }
}
