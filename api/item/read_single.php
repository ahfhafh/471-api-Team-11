<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/item.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$item = new item($db);
  
// get ID
$item->item_id = isset($_GET['item_id']) ? $_GET['item_id'] : die();

// get post
$item->read_single();

if($item->in_stock!=null){
    // create array
    $item_arr = array(
    'item_id' => $item->item_id,
    'brand' => $item->brand,
    'price' => $item->price,
    'description' => $item->description,
    'in_stock' => $item->in_stock,
    'type' => $item->type,
    'section' => $item->section
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(jason_encode($item_arr));
    
}
  
else{
  
    //set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Item cannot be found.")
    );
}