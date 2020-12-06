<?php
class item{
  
    // database connection and table name
    private $conn;
    private $table_name = "item";
  
    // item properties
    public $item_id;
    public $brand;
    public $price;
	public $description;
    public $in_stock;
    public $type;
    public $section;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
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
    public function read_single() {
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
        // creat equery
        $query = "INSERT INTO " . $this->table . "
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
}
?>