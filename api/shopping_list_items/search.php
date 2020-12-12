<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list_items.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$shopping_list_items = new shopping_list_items($db);
  
// get ID
$shopping_list_items->id = isset($_GET['id']) ? $_GET['id'] : die();

// get shopping_list_items
$shopping_list_items->search();

if($shopping_list_items->list_id!=null){
    // create array
    $shopping_list_items_arr = array(
    'id' => $shopping_list_items->id,
    'item_id' => $shopping_list_items->item_id,
    'list_id' => $shopping_list_items->list_id
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($shopping_list_items_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "shopping_list_item cannot be found.")
    );
}