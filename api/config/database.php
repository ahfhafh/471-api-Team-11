<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "shopping_app";
    private $username = "root";
    private $password = "12345pppp";
    public $conn;
  
    // database connection
    public function connect() {
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>