<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/shopper.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$shopper = new shopper($db);
  
// query products
$stmt = $shopper->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $shoppers_arr=array();
    $shoppers_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $shopper_arr = array(
            'shopper_email' => $shopper_email,
            'lists' => $lists,
            'username' => $username
        );
  
        array_push($shoppers_arr["data"], $shopper_arr);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($shoppers_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No shoppers found.")
    );
}