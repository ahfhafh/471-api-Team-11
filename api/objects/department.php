<?php
class department{
  
    // database connection and table name
    private $conn;
    private $table_name = "department";
  
    // department properties
    public $department_id;
    public $name;
    public $store;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read departments
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
    
    // Get single department
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            department_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->department_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->name = $row['name'];
        $this->store = $row['store'];
    }

    // create department
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                name = :name,
                store = :store";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store = htmlspecialchars(strip_tags($this->store));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":store", $this->store);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update department
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                store = :store
            WHERE
                department_id = :department_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store = htmlspecialchars(strip_tags($this->store));
        $this->department_id = htmlspecialchars(strip_tags($this->department_id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":store", $this->store);
        $stmt->bindParam(":department_id", $this->department_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete department
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE department_id = :department_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->department_id = htmlspecialchars(strip_tags($this->department_id));

        // bind data
        $stmt->bindParam(":department_id", $this->department_id);

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