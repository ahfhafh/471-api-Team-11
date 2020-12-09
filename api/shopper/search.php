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
  
// get ID
$shopper->username = isset($_GET['username']) ? $_GET['username'] : die();

// get shopper
$shopper->search();

if($shopper->username!=null){
    // create array
    $shopper_arr = array(
        'username' => $shopper->username,
        'lists' => $shopper->lists,
        'shopper_email' => $shopper->shopper_email
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($shopper_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "shopper cannot be found.")
    );
}