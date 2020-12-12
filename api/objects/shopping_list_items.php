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
                item_id = ?";
    
            // prepare query statement
            $stmt = $this->conn->prepare($query);
    
            // bind ID
            $stmt->bindParam(1, $this->item_id);
    
            // execute query
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set properties
            $this->brand = $row['brand'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->in_stock= $row['in_stock'];
            $this->type = $row['type'];
            $this->section = $row['section'];
    
        }
    
        // create item
        public function create() {
            // create query
            $query = "INSERT INTO " . $this->table_name . "
                SET
                    brand = :brand,
                    price = :price,
                    description = :description,
                    in_stock = :in_stock,
                    type = :type,
                    section = :section";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->brand = htmlspecialchars(strip_tags($this->brand));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->in_stock = htmlspecialchars(strip_tags($this->in_stock));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->section = htmlspecialchars(strip_tags($this->section));
    
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":in_stock", $this->in_stock);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":section", $this->section);
    
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
                    brand = :brand,
                    price = :price,
                    description = :description,
                    in_stock = :in_stock,
                    type = :type,
                    section = :section
                WHERE
                    item_id = :item_id";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->brand = htmlspecialchars(strip_tags($this->brand));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->in_stock = htmlspecialchars(strip_tags($this->in_stock));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->section = htmlspecialchars(strip_tags($this->section));
            $this->item_id = htmlspecialchars(strip_tags($this->item_id));
    
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":in_stock", $this->in_stock);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":section", $this->section);
            $stmt->bindParam(":item_id", $this->item_id);
    
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
            $query = "DELETE FROM " . $this->table_name . " WHERE item_id = :item_id";
    
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
    }
?>