<?php
class shopping_list_items{
  
    // database connection and table name
    private $conn;
    private $table_name = "shopping_list_items";
  
    // shopping_list_items properties
    public $id;
    public $item_id;
    public $list_id;

    public $description;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // add item
    public function add_item() {

        // get lowest priced item from item table
        // select query
        $query = "SELECT item_id
                FROM
                    item
                WHERE
                    price = (SELECT MIN(price)
                            FROM item)
                    AND
                    description = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind description
        $stmt->bindParam(1, $this->description);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->item_id = $row['item_id'];



        // Insert all info
        // create query
        $query2 = "INSERT INTO " . $this->table_name . "
            SET
                list_id = :list_id,
                item_id = :item_id";

        // prepare statement
        $stmt = $this->conn->prepare($query2);

        // clean data
        $this->item_id = htmlspecialchars(strip_tags($this->item_id));
        $this->list_id = htmlspecialchars(strip_tags($this->list_id));

        // bind data
        $stmt->bindParam(":item_id", $this->item_id);
        $stmt->bindParam(":list_id", $this->list_id);

        // execute query
        if($stmt->execute()) {
            return true;
        }
        
        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

		// read items
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
        
        // Get single item
        public function search() {
            
            // select query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE
                id = ?";
    
            // prepare query statement
            $stmt = $this->conn->prepare($query);
    
            // bind ID
            $stmt->bindParam(1, $this->id);
    
            // execute query
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set properties
            $this->item_id = $row['item_id'];
            $this->list_id = $row['list_id'];
    
        }
    
        // create item
        public function create() {
            // create query
            $query = "INSERT INTO " . $this->table_name . "
                SET
                    item_id = :item_id,
                    list_id = :list_id";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->item_id = htmlspecialchars(strip_tags($this->item_id));
            $this->list_id = htmlspecialchars(strip_tags($this->list_id));
    
            // bind data
            $stmt->bindParam(":item_id", $this->item_id);
            $stmt->bindParam(":list_id", $this->list_id);
    
            // execute query
            if($stmt->execute()) {
                return true;
            }
            
            // print error
            printf("Error: %s.\n", $stmt->error);
    
            return false;
            
        }
    
        // update item
        public function update() {
            // create query
            $query = "UPDATE " . $this->table_name . "
                SET
                    list_id = :list_id,
                    item_id = :item_id
                WHERE
                    id = :id";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->item_id = htmlspecialchars(strip_tags($this->item_id));
            $this->list_id = htmlspecialchars(strip_tags($this->list_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // bind data
            $stmt->bindParam(":item_id", $this->item_id);
            $stmt->bindParam(":list_id", $this->list_id);
            $stmt->bindParam(":id", $this->id);
    
            // execute query
            if($stmt->execute()) {
                return true;
            }
            
            // print error
            printf("Error: %s.\n", $stmt->error);
    
            return false;
        }
    
        // delete item
        public function delete() {
            // create query
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // bind data
            $stmt->bindParam(":id", $this->id);
    
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