<?php
class section{
  
    // database connection and table name
    private $conn;
    private $table_name = "section";
  
    // section properties
    public $name;
    public $inventory;
  
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
            name = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->name);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->inventory = $row['inventory'];

    }

    // create section
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                name = :name,
                inventory = :inventory";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->inventory = htmlspecialchars(strip_tags($this->inventory));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":inventory", $this->inventory);

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
                inventory = :inventory
            WHERE
                name = :name";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->inventory = htmlspecialchars(strip_tags($this->inventory));
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind data
        $stmt->bindParam(":inventory", $this->inventory);
        $stmt->bindParam(":name", $this->name);

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
        $query = "DELETE FROM " . $this->table_name . " WHERE name = :name";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind data
        $stmt->bindParam(":name", $this->name);

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