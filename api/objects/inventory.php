<?php
class inventory{
  
    // database connection and table name
    private $conn;
    private $table_name = "inventory";
  
    // inventory properties
    public $inventory_id;
    public $item_id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read inventories
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
    
    // Get single inventory
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            inventory_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->inventory_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->item_id = $row['item_id'];

    }

    // create inventory
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                item_id = :item_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));

        // bind data
        $stmt->bindParam(":item_id", $this->item_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update inventory
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                item_id = :item_id
            WHERE
                inventory_id = :inventory_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));
        $this->inventory_id = htmlspecialchars(strip_tags($this->inventory_id));

        // bind data
        $stmt->bindParam(":item_id", $this->item_id);
        $stmt->bindParam(":inventory_id", $this->inventory_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete inventory
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE inventory_id = :inventory_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->inventory_id = htmlspecialchars(strip_tags($this->inventory_id));

        // bind data
        $stmt->bindParam(":inventory_id", $this->inventory_id);

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