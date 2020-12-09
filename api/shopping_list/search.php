<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$shopping_list = new shopping_list($db);
  
// get ID
$shopping_list->name = isset($_GET['name']) ? $_GET['name'] : die();

// get shopping_list
$shopping_list->read_single();

if($shopping_list->list_id!=null){
    // create array
    $shopping_list_arr = array(
    'name' => $shopping_list->name,
    'item_id' => $shopping_list->item_id,
    'list_id' => $shopping_list->list_id
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($shopping_list_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "shopping_list cannot be found.")
    );
}