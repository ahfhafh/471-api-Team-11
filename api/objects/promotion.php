<?php
class promotion{
  
    // database connection and table name
    private $conn;
    private $table_name = "promotion";
  
    // promotion properties
    public $promotion_id;
    public $date;
    public $name;
	public $item;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read promotions
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
    
    // Get single promotion
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            promotion_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->promotion_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->date = $row['date'];
        $this->name = $row['name'];
        $this->item = $row['item'];

    }

    // create promotion
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                date = :date,
                name = :name,
                item = :item";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->item = htmlspecialchars(strip_tags($this->item));

        // bind data
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":item", $this->item);
        $stmt->bindParam(":name", $this->name);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    // update promotion
    public function update() {
        // create query
        $query = "UPDATE " . $this->table_name . "
            SET
                date = :date,
                name = :name,
                item = :item
            WHERE
                promotion_id = :promotion_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->item = htmlspecialchars(strip_tags($this->item));
        $this->promotion_id = htmlspecialchars(strip_tags($this->promotion_id));

        // bind data
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":item", $this->item);
        $stmt->bindParam(":promotion_id", $this->promotion_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete promotion
    public function delete() {
        // create query
        $query = "DELETE FROM " . $this->table_name . " WHERE promotion_id = :promotion_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->promotion_id = htmlspecialchars(strip_tags($this->promotion_id));

        // bind data
        $stmt->bindParam(":promotion_id", $this->promotion_id);

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