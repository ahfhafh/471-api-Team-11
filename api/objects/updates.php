<?php
class updates{
  
    // database connection and table name
    private $conn;
    private $table_name = "updates";
  
    // updates properties
    public $admin_id;
    public $inventory;
    public $item_added;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read updatess
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
    
    // Get single updates
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            item_added = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->item_added);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->admin_id = $row['admin_id'];
        $this->inventory = $row['inventory'];
        $this->item_added = $row['item_added'];

    }

    // create updates
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                admin_id = :admin_id,
                inventory = :inventory";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        $this->inventory = htmlspecialchars(strip_tags($this->inventory));

        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":inventory", $this->inventory);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update updates
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                admin_id = :admin_id,
                inventory = :inventory,
                item_added = :item_added
            WHERE
                item_added = :item_added";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        $this->inventory = htmlspecialchars(strip_tags($this->inventory));
        $this->item_added = htmlspecialchars(strip_tags($this->item_added));


        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":inventory", $this->inventory);
        $stmt->bindParam(":item_added", $this->item_added);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete updates
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE item_added = :item_added";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->item_added = htmlspecialchars(strip_tags($this->item_added));

        // bind data
        $stmt->bindParam(":item_added", $this->item_added);

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