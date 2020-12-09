<?php
class shopper{
  
    // database connection and table name
    private $conn;
    private $table_name = "shopper";
  
    // shopper properties
    public $username;
    public $lists;
    public $shopper_email;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read sections
	public function read(){
  
		// select query
		$query = "SELECT
                *
            FROM
                " . $this->table_name . " as i";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }
    
    // Get single section
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            username = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->username);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->lists = $row['lists'];
        $this->shopper_email = $row['shopper_email'];
    }

    // create section
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                username = :username,
                lists = :lists,
                shopper_email = :shopper_email";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->shopper_email = htmlspecialchars(strip_tags($this->shopper_email));
        $this->lists = htmlspecialchars(strip_tags($this->lists));
        $this->username = htmlspecialchars(strip_tags($this->username));

        // bind data
        $stmt->bindParam(":shopper_email", $this->shopper_email);
        $stmt->bindParam(":lists", $this->lists);
        $stmt->bindParam(":username", $this->username);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update section
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                shopper_email = :shopper_email,
                lists = :lists
            WHERE
                username = :username";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->lists = htmlspecialchars(strip_tags($this->lists));
        $this->shopper_email = htmlspecialchars(strip_tags($this->shopper_email));

        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":lists", $this->lists);
        $stmt->bindParam(":shopper_email", $this->shopper_email);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete section
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE username = :username";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->username = htmlspecialchars(strip_tags($this->username));

        // bind data
        $stmt->bindParam(":username", $this->username);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>