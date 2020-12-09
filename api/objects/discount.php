<?php
class discount{
  
    // database connection and table name
    private $conn;
    private $table_name = "discount";
  
    // discount properties
    public $discount_id;
    public $name;
    public $store;
    public $item_id;
    public $date_end;
    public $owner;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read discounts
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
    
    // Get single discount
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            discount_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->discount_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->store = $row['store'];
        $this->item_id = $row['item_id'];
        $this->name = $row['name'];
        $this->date_end = $row['date_end'];
        $this->owner = $row['owner'];
    }

    // create discount
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                item_id = :item_id,
                name = :name,
                date_end = :date_end,
                owner = :owner,
                store = :store";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store = htmlspecialchars(strip_tags($this->store));
        $this->owner = htmlspecialchars(strip_tags($this->owner));
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":store", $this->store);
        $stmt->bindParam(":owner", $this->owner);
        $stmt->bindParam(":item_id", $this->item_id);
        $stmt->bindParam(":date_end", $this->date_end);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update discount
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                owner = :owner,
                item_id = :item_id,
                date_end = :date_end,
                store = :store
            WHERE
                discount_id = :discount_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store = htmlspecialchars(strip_tags($this->store));
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));
        $this->owner = htmlspecialchars(strip_tags($this->owner));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));
        $this->discount_id = htmlspecialchars(strip_tags($this->discount_id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":store", $this->store);
        $stmt->bindParam(":owner", $this->owner);
        $stmt->bindParam(":item_id", $this->item_id);
        $stmt->bindParam(":date_end", $this->date_end);
        $stmt->bindParam(":discount_id", $this->discount_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete discount
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE discount_id = :discount_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->discount_id = htmlspecialchars(strip_tags($this->discount_id));

        // bind data
        $stmt->bindParam(":discount_id", $this->discount_id);

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