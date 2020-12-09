<?php
class shopping_list{
  
    // database connection and table name
    private $conn;
    private $table_name = "shopping_list";
  
    // shopping_list properties
    public $name;
    public $item_id;
    public $list_id;
  
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
    public function read_single() {
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
        $this->item_id = $row['item_id'];
        $this->list_id = $row['list_id'];
    }

    // create section
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                name = :name,
                item_id = :item_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":item_id", $this->item_id);

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
                name = :name,
                item_id = :item_id
            WHERE
                list_id = :list_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->list_id = htmlspecialchars(strip_tags($this->list_id));
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind data
        $stmt->bindParam(":list_id", $this->list_id);
        $stmt->bindParam(":item_id", $this->item_id);
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