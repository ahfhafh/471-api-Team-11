<?php
class store{
  
    // database connection and table name
    private $conn;
    private $table_name = "store";
  
    // store properties
    public $store_id;
    public $location;
    public $name;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read stores
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
    
    // Get single store
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            store_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->store_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->location = $row['location'];
        $this->name = $row['name'];

    }

    // create store
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                location = :location,
                name = :name";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind data
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":name", $this->name);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update store
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                location = :location,
                name = :name
            WHERE
                store_id = :store_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store_id = htmlspecialchars(strip_tags($this->store_id));

        // bind data
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":store_id", $this->store_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete store
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE store_id = :store_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->store_id = htmlspecialchars(strip_tags($this->store_id));

        // bind data
        $stmt->bindParam(":store_id", $this->store_id);

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