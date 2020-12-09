<?php
class admin{
  
    // database connection and table name
    private $conn;
    private $table_name = "admin";
  
    // admin properties
    public $admin_id;
    public $email;
  
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
    public function search() {
        // select query
        $query = "SELECT
            *
        FROM
            " . $this->table_name . "
        WHERE
            admin_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->admin_id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->email = $row['email'];
    }

    // create section
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                email = :email";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind data
        $stmt->bindParam(":email", $this->email);

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
                email = :email
            WHERE
                admin_id = :admin_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":email", $this->email);

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
        $query = "DELETE FROM " . $this->table_name . " WHERE admin_id = :admin_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));

        // bind data
        $stmt->bindParam(":admin_id", $this->admin_id);

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