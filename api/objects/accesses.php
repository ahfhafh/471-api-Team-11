<?php
class accesses{
  
    // database connection and table name
    private $conn;
    private $table_name = "accesses";
  
    // accesses properties
    public $accesses_id;
    public $admin_id;
    public $store_id;
    public $item_obtained;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read accessess
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
    
    // Get single accesses
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            accesses_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->accesses_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->admin_id = $row['admin_id'];
        $this->store_id = $row['store_id'];
        $this->item_obtained = $row['item_obtained'];

    }

    // create accesses
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                admin_id = :admin_id,
                store_id = :store_id,
                item_obtained = :item_obtained";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        $this->store_id = htmlspecialchars(strip_tags($this->store_id));
        $this->item_obtained = htmlspecialchars(strip_tags($this->item_obtained));

        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":store_id", $this->store_id);
        $stmt->bindParam(":item_obtained", $this->item_obtained);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update accesses
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                admin_id = :admin_id,
                store_id = :store_id,
                item_obtained = :item_obtained
            WHERE
                accesses_id = :accesses_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        $this->store_id = htmlspecialchars(strip_tags($this->store_id));
        $this->item_obtained = htmlspecialchars(strip_tags($this->item_obtained));
        $this->accesses_id = htmlspecialchars(strip_tags($this->accesses_id));


        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":store_id", $this->store_id);
        $stmt->bindParam(":item_obtained", $this->item_obtained);
        $stmt->bindParam(":accesses_id", $this->accesses_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete accesses
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE accesses_id = :accesses_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->accesses_id = htmlspecialchars(strip_tags($this->accesses_id));

        // bind data
        $stmt->bindParam(":accesses_id", $this->accesses_id);

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