<?php
class user{
  
    // database connection and table name
    private $conn;
    private $table_name = "user";
  
    // user properties
    public $email;
    public $Fname;
    public $Lname;
    public $phone;
  
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
            email = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind ID
        $stmt->bindParam(1, $this->email);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->Fname = $row['Fname'];
        $this->Lname = $row['Lname'];
        $this->phone = $row['phone'];
    }

    // create section
    public function create() {
        // create query
        $query = "INSERT INTO " . $this->table_name . "
            SET
                email = :email,
                Fname = :Fname,
                Lname = :Lname,
                phone = :phone";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->Fname = htmlspecialchars(strip_tags($this->Fname));
        $this->Lname = htmlspecialchars(strip_tags($this->Lname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // bind data
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":Fname", $this->Fname);
        $stmt->bindParam(":Lname", $this->Lname);
        $stmt->bindParam(":phone", $this->phone);

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
                phone = :phone,
                Lname = :Lname,
                Fname = :Fname
            WHERE
                email = :email";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->Lname = htmlspecialchars(strip_tags($this->Lname));
        $this->Fname = htmlspecialchars(strip_tags($this->Fname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind data
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":Lname", $this->Lname);
        $stmt->bindParam(":Fname", $this->Fname);
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
        $query = "DELETE FROM " . $this->table_name . " WHERE email = :email";

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
}
?>