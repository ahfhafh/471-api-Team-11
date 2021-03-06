<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$user = new user($db);
  
// query products
$stmt = $user->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $users_arr=array();
    $users_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $user_arr = array(
            'email' => $email,
            'Fname' => $Fname,
            'Lname' => $Lname,
            'phone' => $phone
        );
  
        array_push($users_arr["data"], $user_arr);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($users_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No users found.")
    );
}